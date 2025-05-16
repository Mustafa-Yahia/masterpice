<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Exports\EventsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminEventController extends Controller
{
public function index()
{
    $now = Carbon::now();

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
        ->orderBy('time', 'asc')
        ->paginate(10);

    // حساب عدد الأحداث مع تحسين تحديد الحالة
    $totalEventsCount = Event::count();
    $upcomingEventsCount = Event::where(function($query) use ($now) {
        $query->whereDate('date', '>', $now->format('Y-m-d'))
              ->orWhere(function($q) use ($now) {
                  $q->whereDate('date', '=', $now->format('Y-m-d'))
                    ->whereTime('end_time', '>', $now->format('H:i:s'));
              });
    })->count();

    $pastEventsCount = Event::where(function($query) use ($now) {
        $query->whereDate('date', '<', $now->format('Y-m-d'))
              ->orWhere(function($q) use ($now) {
                  $q->whereDate('date', '=', $now->format('Y-m-d'))
                    ->whereTime('end_time', '<=', $now->format('H:i:s'));
              });
    })->count();

    $totalVolunteers = Event::sum('volunteers_needed');

    return view('admin.events.index', compact(
        'events',
        'totalEventsCount',
        'upcomingEventsCount',
        'pastEventsCount',
        'totalVolunteers',
        'now'
    ));
}

public function create()
{
    return view('admin.events.create');
}

public function store(Request $request)
{
    // تحويل الوقت من 12 ساعة إلى 24 ساعة للتحقق
    try {
        $request->merge([
            'time_24h' => Carbon::createFromFormat('h:i A', $request->time)->format('H:i'),
            'end_time_24h' => Carbon::createFromFormat('h:i A', $request->end_time)->format('H:i')
        ]);
    } catch (\Exception $e) {
        return back()->withInput()->withErrors([
            'time' => 'صيغة وقت البدء غير صالحة. استخدم مثل: 08:30 AM',
            'end_time' => 'صيغة وقت الانتهاء غير صالحة. استخدم مثل: 05:30 PM'
        ]);
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => [
            'required',
            'date',
            'after_or_equal:today',
            function ($attribute, $value, $fail) use ($request) {
                $eventDateTime = Carbon::createFromFormat('Y-m-d h:i A', $value . ' ' . $request->time);
                if ($eventDateTime->isPast()) {
                    $fail('لا يمكن إنشاء حدث في وقت ماضي');
                }
            },
        ],
        'time' => [
            'required',
            'regex:/^(1[0-2]|0?[1-9]):[0-5][0-9] (AM|PM)$/'
        ],
        'end_time' => [
            'required',
            'regex:/^(1[0-2]|0?[1-9]):[0-5][0-9] (AM|PM)$/',
            function ($attribute, $value, $fail) use ($request) {
                $start = Carbon::createFromFormat('h:i A', $request->time);
                $end = Carbon::createFromFormat('h:i A', $value);

                if ($end <= $start) {
                    $fail('وقت الانتهاء يجب أن يكون بعد وقت البدء');
                }

                $duration = $end->diffInHours($start);
                if ($duration > 6) {
                    $fail('مدة الحدث يجب ألا تزيد عن 6 ساعات');
                }
            },
        ],
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
    ], [
        'time.required' => 'حقل وقت البدء مطلوب',
        'time.regex' => 'صيغة الوقت غير صالحة (استخدم مثل: 08:30 AM)',
        'end_time.required' => 'حقل وقت الانتهاء مطلوب',
        'end_time.regex' => 'صيغة الوقت غير صالحة (استخدم مثل: 05:30 PM)',
        'mission.required' => 'حقل المهمة مطلوب',
        'date.after_or_equal' => 'لا يمكن إنشاء حدث لتاريخ سابق',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('events', 'public');
    }

    // تحويل الوقت لحفظه في قاعدة البيانات
    $validated['time'] = Carbon::createFromFormat('h:i A', $validated['time'])->format('H:i:s');
    $validated['end_time'] = Carbon::createFromFormat('h:i A', $validated['end_time'])->format('H:i:s');

    Event::create($validated);

    return redirect()->route('admin.events.index')
                   ->with('swal', [
                       'icon' => 'success',
                       'title' => 'تم الإنشاء بنجاح',
                       'text' => 'تم إنشاء الحدث بنجاح'
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

    try {
        // تحويل الوقت من 12 ساعة إلى 24 ساعة للتحقق
        $request->merge([
            'time_24h' => Carbon::createFromFormat('h:i A', $request->time)->format('H:i'),
            'end_time_24h' => Carbon::createFromFormat('h:i A', $request->end_time)->format('H:i')
        ]);
    } catch (\Exception $e) {
        return back()->withInput()->withErrors([
            'time' => 'صيغة وقت البدء غير صالحة. استخدم مثل: 08:30 AM',
            'end_time' => 'صيغة وقت الانتهاء غير صالحة. استخدم مثل: 05:30 PM'
        ]);
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($request, $event) {
                try {
                    $eventDateTime = Carbon::createFromFormat('Y-m-d h:i A', $value . ' ' . $request->time);
                    if ($eventDateTime->isPast() && !$event->isPast()) {
                        $fail('لا يمكن تغيير التاريخ إلى وقت ماضي');
                    }
                } catch (\Exception $e) {
                    $fail('تنسيق التاريخ أو الوقت غير صالح');
                }
            },
        ],
        'time' => [
            'required',
            'regex:/^(1[0-2]|0?[1-9]):[0-5][0-9] (AM|PM)$/'
        ],
        'end_time' => [
            'required',
            'regex:/^(1[0-2]|0?[1-9]):[0-5][0-9] (AM|PM)$/',
            function ($attribute, $value, $fail) use ($request) {
                try {
                    $start = Carbon::createFromFormat('h:i A', $request->time);
                    $end = Carbon::createFromFormat('h:i A', $value);

                    if ($end <= $start) {
                        $fail('وقت الانتهاء يجب أن يكون بعد وقت البدء');
                    }

                    $duration = $end->diffInHours($start);
                    if ($duration > 6) {
                        $fail('مدة الحدث يجب ألا تزيد عن 6 ساعات');
                    }
                } catch (\Exception $e) {
                    $fail('تنسيق الوقت غير صالح');
                }
            },
        ],
        'location' => 'required|string|max:255',
        'location_url' => 'required|url',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'volunteers_needed' => 'required|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'mission' => 'required|string',
        'mission_point_1' => 'required|string|max:255',
        'mission_point_2' => 'required|string|max:255',
        'mission_point_3' => 'required|string|max:255',
    ], [
        'time.required' => 'حقل وقت البدء مطلوب',
        'time.regex' => 'صيغة وقت البدء غير صالحة. استخدم مثل: 08:30 AM',
        'end_time.required' => 'حقل وقت الانتهاء مطلوب',
        'end_time.regex' => 'صيغة وقت الانتهاء غير صالحة. استخدم مثل: 05:30 PM',
        'mission.required' => 'حقل المهمة مطلوب',
    ]);

    if ($request->hasFile('image')) {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $validated['image'] = $request->file('image')->store('events', 'public');
    } else {
        $validated['image'] = $event->image;
    }

    $validated['time'] = Carbon::createFromFormat('h:i A', $validated['time'])->format('H:i:s');
    $validated['end_time'] = Carbon::createFromFormat('h:i A', $validated['end_time'])->format('H:i:s');

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


    public function exportToExcel()
{
    return Excel::download(new EventsExport, 'الأحداث.xlsx');
}

public function removeVolunteer(Event $event, User $volunteer)
{
    if (!$event->volunteers()->where('user_id', $volunteer->id)->exists()) {
        return back()->with('error', 'المتطوع غير مسجل في هذا الحدث');
    }

    $event->volunteers()->detach($volunteer->id);

    return back()->with('success', 'تم إزالة المتطوع بنجاح');
}
}
