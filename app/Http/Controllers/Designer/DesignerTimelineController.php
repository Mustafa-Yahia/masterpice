<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\TimelineEvent;
use Illuminate\Http\Request;

class DesignerTimelineController extends Controller
{
    // عرض قائمة الأحداث
    public function index()
    {
        $events = TimelineEvent::orderBy('year', 'desc')->paginate(10);
        return view('designer.timeline.index', compact('events'));
    }

    // عرض نموذج الإضافة
    public function create()
    {
        return view('designer.timeline.create');
    }

    // حفظ الحدث الجديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        TimelineEvent::create($validated);

        return redirect()->route('designer.timeline.index')
            ->with('success', 'تمت إضافة الحدث بنجاح');
    }

    // عرض نموذج التعديل
    public function edit(TimelineEvent $timeline)
    {
        return view('designer.timeline.edit', compact('timeline'));
    }

    // تحديث الحدث
    public function update(Request $request, TimelineEvent $timeline)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $timeline->update($validated);

        return redirect()->route('designer.timeline.index')
            ->with('success', 'تم تحديث الحدث بنجاح');
    }

    // حذف الحدث
    public function destroy(TimelineEvent $timeline)
    {
        $timeline->delete();

        return redirect()->route('designer.timeline.index')
            ->with('success', 'تم حذف الحدث بنجاح');
    }
}
