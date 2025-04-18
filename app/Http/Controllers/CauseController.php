<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use Illuminate\Http\Request;

class CauseController extends Controller
{
    public function index()
    {
        $causes = Cause::paginate(6);
        return view('cause.index', compact('causes'));
    }

    public function cause(Request $request)
    {
        $query = Cause::query();

        // تصفية حسب العنوان
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // تصفية حسب الفئة
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // تصفية حسب الهدف
        if ($request->filled('goal_amount')) {
            $query->where('goal_amount', '>=', $request->goal_amount);
        }

        // تصفية حسب تاريخ الانتهاء
        if ($request->filled('end_time')) {
            $query->whereDate('end_time', '<=', $request->end_time);
        }

        // تصفية حسب الموقع
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // جلب الحملة بناءً على الاستعلام
        $causes = $query->paginate(9);

        // جلب الفئات الفريدة للموقع
        $categories = Cause::select('category')->distinct()->pluck('category');
        $locations = Cause::select('location')->distinct()->pluck('location'); // جلب المواقع الفريدة

        // التحقق مما إذا كان الطلب AJAX وإرجاع نتائج فلاتر محددة
        if ($request->ajax()) {
            return view('cause.partials.causes-list', compact('causes'))->render();
        }

        // إرجاع العرض مع البيانات المطلوبة
        return view('cause.cause', compact('causes', 'categories', 'locations')); // تمرير المواقع أيضًا
    }


    public function show($id)
    {
        $cause = Cause::findOrFail($id);
        return view('cause.show', compact('cause'));
    }

    public function donate($id)
    {
        $cause = Cause::findOrFail($id);
        return view('donate', compact('cause'));
    }


}
