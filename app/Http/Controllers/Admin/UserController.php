<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Donation;
use App\Models\Event;

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

        $users = $query->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // عرض صفحة إضافة مستخدم
    public function create()
    {
        return view('admin.users.create');
    }

    // حفظ مستخدم جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'role' => 'required|in:donor,admin',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    // عرض صفحة تعديل مستخدم
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'phone' => 'required',
        'role' => 'required|in:donor,admin', // تأكد من تطابق القيم مع قاعدة البيانات
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $updateData = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'role' => $request->role,
    ];

    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->password);
    }

    $user->update($updateData);

    return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح');
}
    // حذف مستخدم
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }


 // app/Http/Controllers/Admin/UserController.php
public function show(User $user)
{
    $user->load([
        'donations' => function($query) {
            $query->with(['cause' => function($q) {
                $q->where(function($query) {
                    $query->whereNull('deleted_at')->orWhereNotNull('deleted_at');
                });
            }, 'paymentMethod'])->latest();
        },
        'events' => function($query) {
            $query->withCount('volunteers')->latest();
        }
    ]);

    return view('admin.users.show', compact('user'));
}
}
