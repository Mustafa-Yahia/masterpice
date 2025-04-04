<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationCategory;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    public function confirmDonation(Request $request)
    {
        // التحقق من المدخلات
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:donation_categories,id',
            'amount' => 'required|numeric|min:1', // الحد الأدنى للمبلغ المطلوب
            'people_count' => 'required|integer|min:1', // الحد الأدنى لعدد الأشخاص
            'currency' => 'required|in:JOD,USD', // التأكد من صحة العملة
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // استرجاع فئة التبرع بناءً على الـ category_id
        $category = DonationCategory::findOrFail($request->category_id);

        // حساب المبلغ الإجمالي بناءً على المدخلات
        $totalAmount = $request->amount * $request->people_count;

        // تمرير البيانات إلى صفحة التأكيد
        return view('donations.confirmation', [
            'category' => $category,
            'amount' => $request->amount,
            'peopleCount' => $request->people_count,
            'totalAmount' => $totalAmount,
            'currency' => $request->currency
        ]);
    }
}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\DonationCategory;

// class DonationController extends Controller
// {
//     public function confirmDonation(Request $request)
//     {
//         // استرجاع فئة التبرع بناءً على الـ category_id
//         $category = DonationCategory::findOrFail($request->category_id);

//         // استرجاع البيانات المرسلة
//         $amount = $request->amount;
//         $peopleCount = $request->people_count;
//         $totalAmount = $request->total_amount;
//         $currency = $request->currency;

//         // تمرير البيانات إلى صفحة التأكيد
//         return view('donations.confirmation', compact('category', 'amount', 'peopleCount', 'totalAmount', 'currency'));
//     }

// }

