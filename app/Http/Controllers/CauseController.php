<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use Illuminate\Http\Request;

class CauseController extends Controller
{
    // عرض 6 أسباب فقط في صفحة index
    public function index()
    {
        // جلب أول 6 أسباب فقط باستخدام paginate
        $causes = Cause::paginate(6); // استخدم paginate للحصول على 6 تبرعات في الصفحة
        return view('cause.cause', compact('causes'));  // استخدم المسار الصحيح هنا
    }

    // عرض جميع الأسباب في صفحة cause
    public function cause()
    {
        // جلب جميع الأسباب بدون تقسيم (عرض كامل)
        $causes = Cause::all();  // استخدم all() لعرض جميع التبرعات
        return view('cause.cause', compact('causes'));  // استخدم المسار الصحيح هنا
    }

    // عرض تفاصيل السبب بناءً على المعرف
    public function show($id)
    {
        $cause = Cause::findOrFail($id);
        return view('cause.show', compact('cause'));  // عرض التفاصيل في 'cause.show.blade.php'
    }
}
