<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TimelineEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role != 'designer') {
                return redirect()->route('home')->with('error', 'Access Denied');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $teams = Team::all();
        $timelineEvents = TimelineEvent::orderBy('year', 'desc')->get();
        return view('designer.dashboard', compact('teams', 'timelineEvents'));
    }

    // ... دوال CRUD للفريق (Team) الموجودة لديك ...

    public function createTimelineEvent()
    {
        return view('designer.timeline.create');
    }

    public function storeTimelineEvent(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        TimelineEvent::create($validated);

        return redirect()->route('designer.dashboard')
               ->with('success', 'تمت إضافة الحدث الزمني بنجاح');
    }

    public function editTimelineEvent($id)
    {
        $event = TimelineEvent::findOrFail($id);
        return view('designer.timeline.edit', compact('event'));
    }

    public function updateTimelineEvent(Request $request, $id)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $event = TimelineEvent::findOrFail($id);
        $event->update($validated);

        return redirect()->route('designer.dashboard')
               ->with('success', 'تم تحديث الحدث الزمني بنجاح');
    }

    public function destroyTimelineEvent($id)
    {
        $event = TimelineEvent::findOrFail($id);
        $event->delete();

        return redirect()->route('designer.dashboard')
               ->with('success', 'تم حذف الحدث الزمني بنجاح');
    }
}
