<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::query()
            ->when(request('search'), function($query) {
                $query->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('description', 'like', '%' . request('search') . '%');
            })
            ->when(request('location'), function($query) {
                $query->where('location', 'like', '%' . request('location') . '%');
            })
            ->when(request('volunteers_needed'), function($query) {
                $range = request('volunteers_needed');
                if ($range == '1-10') {
                    $query->whereBetween('volunteers_needed', [1, 10]);
                } elseif ($range == '10-50') {
                    $query->whereBetween('volunteers_needed', [10, 50]);
                } elseif ($range == '50+') {
                    $query->where('volunteers_needed', '>', 50);
                }
            })
            ->when(request('start_date'), function($query) {
                $query->whereDate('date', '>=', request('start_date'));
            })
            ->when(request('end_date'), function($query) {
                $query->whereDate('date', '<=', request('end_date'));
            })
            ->orderBy('date', 'asc')
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    } 

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'location_url' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'volunteers_needed' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mission' => 'required|string',
            'mission_point_1' => 'nullable|string|max:255',
            'mission_point_2' => 'nullable|string|max:255',
            'mission_point_3' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')
                         ->with('swal', [
                             'icon' => 'success',
                             'title' => 'نجاح',
                             'text' => 'تم إضافة الحدث بنجاح'
                         ]);
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'location_url' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'volunteers_needed' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mission' => 'required|string',
            'mission_point_1' => 'nullable|string|max:255',
            'mission_point_2' => 'nullable|string|max:255',
            'mission_point_3' => 'nullable|string|max:255',
        ]);

        // معالجة صورة الحدث
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        } else {
            // الاحتفاظ بالصورة القديمة إذا لم يتم تحميل صورة جديدة
            $validated['image'] = $event->image;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
                       ->with('swal', [
                           'icon' => 'success',
                           'title' => 'تم التحديث بنجاح',
                           'text' => 'تم تحديث بيانات الحدث بنجاح'
                       ]);
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
                         ->with('swal', [
                             'icon' => 'success',
                             'title' => 'نجاح',
                             'text' => 'تم حذف الحدث بنجاح'
                         ]);
    }
}
