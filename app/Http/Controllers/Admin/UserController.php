<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // عرض جميع المستخدمين
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10); // مع التقسيم الصفحي مثلا 10 عناصر في الصفحة

        return view('admin.users.index', compact('users'));
    }


    // عرض صفحة إضافة مستخدم
    public function create()
    {
        return view('admin.users.create');
    }


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
        'location' => 'required|string',
        'volunteers_needed' => 'required|integer|min:1',
        'mission' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/events');
        $imageName = basename($imagePath); // يحفظ اسم الملف فقط بدون المسار
    }

    Event::create([
        'title' => $request->title,
        'description' => $request->description,
        'date' => $request->date,
        'time' => $request->time,
        'location' => $request->location,
        'location_url' => $request->location_url,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'volunteers_needed' => $request->volunteers_needed,
        'mission' => $request->mission,
        'mission_point_1' => $request->mission_point_1,
        'mission_point_2' => $request->mission_point_2,
        'mission_point_3' => $request->mission_point_3,
        'image' => $imageName ?? null, // يحفظ اسم الملف فقط
    ]);

    return redirect()->route('admin.events.index')->with('success', 'تم إضافة الحدث بنجاح');
}


    // عرض صفحة تعديل مستخدم
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // تحديث بيانات مستخدم
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required',
            'role' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    // حذف مستخدم
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
