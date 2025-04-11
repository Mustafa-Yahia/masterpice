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

    public function filter(Request $request)
    {
        $query = Cause::query();

        // فلاتر الفئة
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // فلاتر الهدف المالي
        if ($request->has('goal_amount') && $request->goal_amount != '') {
            $query->where('goal_amount', '>=', $request->goal_amount);
        }

        // فلاتر الوقت المتبقي
        if ($request->has('end_time') && $request->end_time != '') {
            $query->where('end_time', '>=', $request->end_time);
        }

        // جلب النتائج بعد الفلاتر
        $causes = $query->get();

        // تأكد من استخدام اسم الـ view الصحيح هنا
        return view('cause.cause', compact('causes'));
    }

    public function donate($id)
    {
        // جلب السبب من قاعدة البيانات باستخدام ID
        $cause = Cause::findOrFail($id); // سيعيد السبب بناءً على ID

        // تمرير البيانات إلى العرض
        return view('donate', compact('cause'));
    }

}
