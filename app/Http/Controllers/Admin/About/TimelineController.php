<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\TimelineEvent;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $events = TimelineEvent::all();
        return view('admin.about.timeline.index', compact('events'));
    }
    

    public function create()
    {
        return view('admin.about.timeline.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        TimelineEvent::create($request->all());

        return redirect()->route('admin.about.timeline.index');
    }

    public function edit(TimelineEvent $event)
    {
        return view('admin.about.timeline.edit', compact('event'));
    }

    public function update(Request $request, TimelineEvent $event)
    {
        $request->validate([
            'year' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $event->update($request->all());

        return redirect()->route('admin.about.timeline.index');
    }

    public function destroy(TimelineEvent $event)
    {
        $event->delete();
        return redirect()->route('admin.about.timeline.index');
    }
}

