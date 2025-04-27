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
        if ($request->filled('end_time') && $this->isValidDate($request->end_time)) {
            $query->whereDate('end_time', '<=', $request->end_time);
        }

        // تصفية حسب الموقع
        if ($request->filled('location')) {
            $locations = explode(',', $request->location); // دعم اختيار أكثر من موقع
            $query->whereIn('location', $locations);
        }

        // تصفية حسب ترتيب النتائج
        if ($request->filled('sort_by')) {
            $sortBy = $request->sort_by;
            $sortDirection = $request->sort_direction ?? 'asc'; // تعيين الاتجاه الافتراضي
            $query->orderBy($sortBy, $sortDirection);
        }

        // جلب الحملة بناءً على الاستعلام
        $causes = $query->paginate(9)->appends($request->except('page')); // الحفاظ على الفلاتر أثناء التصفح بين الصفحات

        // جلب الفئات والمواقع الفريدة
        $categories = Cause::select('category')->distinct()->pluck('category');
        $locations = Cause::select('location')->distinct()->pluck('location'); // جلب المواقع الفريدة

        // التحقق مما إذا كان الطلب AJAX وإرجاع نتائج فلاتر محددة
        if ($request->ajax()) {
            if ($causes->isEmpty()) {
                return response()->json(['message' => 'لا توجد نتائج وفقًا للفلاتر المحددة.']);
            }

            return view('cause.partials.causes-list', compact('causes'))->render();
        }

        // إرجاع العرض مع البيانات المطلوبة
        return view('cause.cause', compact('causes', 'categories', 'locations')); // تمرير المواقع والفئات
    }

    // دالة للتحقق من صلاحية التاريخ
    private function isValidDate($date)
    {
        return (bool) strtotime($date); // التحقق من صلاحية التاريخ
    }

    public function show($id)
    {
        $cause = Cause::findOrFail($id);

        $raisedAmountArabic = convertToArabic(number_format($cause->raised_amount));
        $goalAmountArabic = convertToArabic(number_format($cause->goal_amount));

        return view('cause.show', compact('cause', 'raisedAmountArabic', 'goalAmountArabic'));
    }

    public function donate(Request $request, $id)
{
    // العثور على الحملة باستخدام الـ ID
    $cause = Cause::findOrFail($id);

    // المبلغ الذي تم التبرع به
    $donationAmount = $request->amount;

    // حساب المبلغ الزائد إذا كان التبرع أكبر من الهدف
    $excessAmount = 0;
    if ($cause->raised_amount + $donationAmount > $cause->goal_amount) {
        // المبلغ الزائد
        $excessAmount = ($cause->raised_amount + $donationAmount) - $cause->goal_amount;

        // إضافة المبلغ الزائد إلى عمود extra_raised_amount
        $cause->extra_raised_amount += $excessAmount;  // تحديث المبلغ الزائد
    }

    // إضافة المبلغ المجموع إلى raised_amount ولكن لا نتجاوز الهدف
    $cause->raised_amount = min($cause->raised_amount + $donationAmount, $cause->goal_amount);

    // حفظ التحديثات في قاعدة البيانات
    $cause->save();

    // استجابة بعد التبرع
    return response()->json([
        'status' => 'success',
        'message' => 'تم التبرع بنجاح',
    ]);
}

}

// namespace App\Http\Controllers;

// use App\Models\Cause;
// use Illuminate\Http\Request;

// class CauseController extends Controller
// {
//     public function index()
//     {
//         $causes = Cause::paginate(6);
//         return view('cause.index', compact('causes'));
//     }

//     public function cause(Request $request)
// {
//     $query = Cause::query();

//     // تصفية حسب العنوان
//     if ($request->filled('title')) {
//         $query->where('title', 'like', '%' . $request->title . '%');
//     }

//     // تصفية حسب الفئة
//     if ($request->filled('category')) {
//         $query->where('category', $request->category);
//     }

//     // تصفية حسب الهدف
//     if ($request->filled('goal_amount')) {
//         $query->where('goal_amount', '>=', $request->goal_amount);
//     }

//     // تصفية حسب تاريخ الانتهاء
//     if ($request->filled('end_time') && $this->isValidDate($request->end_time)) {
//         $query->whereDate('end_time', '<=', $request->end_time);
//     }

//     // تصفية حسب الموقع
//     if ($request->filled('location')) {
//         $locations = explode(',', $request->location); // دعم اختيار أكثر من موقع
//         $query->whereIn('location', $locations);
//     }

//     // تصفية حسب ترتيب النتائج
//     if ($request->filled('sort_by')) {
//         $sortBy = $request->sort_by;
//         $sortDirection = $request->sort_direction ?? 'asc'; // تعيين الاتجاه الافتراضي
//         $query->orderBy($sortBy, $sortDirection);
//     }

//     // جلب الحملة بناءً على الاستعلام
//     $causes = $query->paginate(9)->appends($request->except('page')); // الحفاظ على الفلاتر أثناء التصفح بين الصفحات

//     // جلب الفئات والمواقع الفريدة
//     $categories = Cause::select('category')->distinct()->pluck('category');
//     $locations = Cause::select('location')->distinct()->pluck('location'); // جلب المواقع الفريدة

//     // التحقق مما إذا كان الطلب AJAX وإرجاع نتائج فلاتر محددة
//     if ($request->ajax()) {
//         if ($causes->isEmpty()) {
//             return response()->json(['message' => 'لا توجد نتائج وفقًا للفلاتر المحددة.']);
//         }

//         return view('cause.partials.causes-list', compact('causes'))->render();
//     }

//     // إرجاع العرض مع البيانات المطلوبة
//     return view('cause.cause', compact('causes', 'categories', 'locations')); // تمرير المواقع والفئات
// }

// // دالة للتحقق من صلاحية التاريخ
// private function isValidDate($date)
// {
//     return (bool) strtotime($date); // التحقق من صلاحية التاريخ
// }


//     public function show($id)
//     {
//         // جلب الحملة باستخدام الـ ID
//         $cause = Cause::findOrFail($id);

//         // تحويل المبالغ إلى الأرقام العربية
//         $raisedAmountArabic = convertToArabic(number_format($cause->raised_amount));
//         $goalAmountArabic = convertToArabic(number_format($cause->goal_amount));

//         // تمرير البيانات إلى الـ view
//         return view('cause.show', compact('cause', 'raisedAmountArabic', 'goalAmountArabic'));
//     }


//     public function donate($id)
//     {
//         $cause = Cause::findOrFail($id);
//         return view('donate', compact('cause'));
//     }


// } -->
