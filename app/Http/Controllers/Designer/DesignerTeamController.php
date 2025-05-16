<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DesignerTeamController extends Controller
{
    // عرض قائمة الأعضاء (Index)
    public function index()
    {
        $members = Team::all();
        return view('designer.team.index', compact('members'));
    }

    // عرض نموذج الإضافة (Create)
    public function create()
    {
        return view('designer.team.create');
    }

    // حفظ العضو الجديد (Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'email' => 'nullable|email',
        ]);

        $data = $request->except('_token');

        // رفع الصورة إذا وجدت
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        Team::create($data);

        return redirect()->route('designer.team.index')
            ->with('success', 'تمت إضافة العضو بنجاح.');
    }

    // عرض تفاصيل العضو (Show) - اختياري
    public function show(Team $team)
    {
        return view('designer.team.show', compact('team'));
    }

    // عرض نموذج التعديل (Edit)
    public function edit($id)
    {
        $member = Team::findOrFail($id);
        return view('designer.team.edit', compact('member'));
    }

    // تحديث بيانات العضو (Update)
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'email' => 'nullable|email',
        ]);

        $data = $request->except('_token', '_method');

        // تحديث الصورة إذا تم رفع جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        $team->update($data);

        return redirect()->route('designer.team.index')
            ->with('success', 'تم تحديث بيانات العضو بنجاح.');
    }

    // حذف العضو (Destroy)
    public function destroy(Team $team)
    {
        // حذف الصورة إذا كانت موجودة
        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return redirect()->route('designer.team.index')
            ->with('success', 'تم حذف العضو بنجاح.');
    }
}
