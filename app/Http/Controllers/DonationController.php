<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationCategory;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    public function confirmDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:donation_categories,id',
            'amount' => 'required|numeric|min:1',
            'people_count' => 'required|integer|min:1',
            'currency' => 'required|in:JOD,USD',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = DonationCategory::findOrFail($request->category_id);
        $totalAmount = $request->amount * $request->people_count;

        return view('donations.confirmation', [
            'category' => $category,
            'amount' => $request->amount,
            'peopleCount' => $request->people_count,
            'totalAmount' => $totalAmount,
            'currency' => $request->currency
        ]);
    }

    public function store(Request $request)
    {
        // التحقق إذا كان المستخدم مسجلاً دخول
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'من فضلك قم بتسجيل الدخول أولاً');
        }

        // التحقق من المدخلات
        $request->validate([
            'payment_method' => 'required|string',
            'paypal_email' => 'nullable|email',
            'credit_card_name' => 'nullable|string',
            'credit_card_number' => 'nullable|string',
            'credit_card_expiry' => 'nullable|string',
            'credit_card_cvc' => 'nullable|string',
            'amount' => 'required|numeric',
        ]);

        if (!$request->amount) {
            return redirect()->back()->withErrors(['amount' => 'المبلغ مطلوب']);
        }

        $donation = new Donation();
        $donation->amount = $request->amount;
        $donation->currency = $request->currency;
        $donation->payment_method = $request->payment_method;
        $donation->paypal_email = $request->paypal_email;
        $donation->credit_card_name = $request->credit_card_name;
        $donation->credit_card_number = $request->credit_card_number;
        $donation->credit_card_expiry = $request->credit_card_expiry;
        $donation->credit_card_cvc = $request->credit_card_cvc;
        $donation->user_id = auth()->user()->id;
        $donation->save();

        return redirect()->route('donation.thank-you');

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

