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

    // Controller method to handle donation processing
public function storeDonation(Request $request)
{
    // Validation
    $request->validate([
        'amount' => 'required|numeric|min:' . $category->amount, // التأكد من أن المبلغ أكبر أو يساوي المبلغ المطلوب
        'payment_method' => 'required',
        'credit_card_number' => 'required_if:payment_method,credit_card',
        'credit_card_expiry' => 'required_if:payment_method,credit_card',
        'credit_card_cvc' => 'required_if:payment_method,credit_card',
        'paypal_email' => 'required_if:payment_method,paypal|email',
    ]);

    // إضافة التبرع إلى قاعدة البيانات
    $donation = new Donation();
    $donation->user_id = auth()->id(); // معرف المستخدم
    $donation->category_id = $category->id;
    $donation->amount = $request->amount;
    $donation->currency = $request->currency;
    $donation->payment_method = $request->payment_method;
    $donation->payment_status = 'success'; // يمكنك إضافة حالة الدفع مثل "في انتظار الدفع" إذا كنت بحاجة
    $donation->people_count = $request->people_count;
    $donation->save();

    // إظهار صفحة الشكر بعد الحفظ
    return view('thank-you', compact('donation'));
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

