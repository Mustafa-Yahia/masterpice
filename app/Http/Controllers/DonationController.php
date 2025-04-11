<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationCategory;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use App\Models\Cause;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'cause_id' => 'required|exists:causes,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'card_holder_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:20',
            'card_expiry' => 'required|string|max:7',
            'card_cvc' => 'required|string|max:4',
        ]);

        $donation = Donation::create([
            'amount' => $request->amount,
            'currency' => 'JOD',
            'card_holder_name' => $request->card_holder_name,
            'card_number' => $request->card_number,
            'card_expiry' => $request->card_expiry,
            'card_cvc' => $request->card_cvc,
            'user_id' => auth()->check() ? auth()->id() : null,
            'cause_id' => $request->cause_id,
            'payment_method_id' => $request->payment_method_id,
        ]);

        // ✅ تحديث raised_amount للحملة
        $cause = $donation->cause;
        $cause->raised_amount += $donation->amount;
        $cause->save();

        return redirect()->route('cause.show', $request->cause_id)->with('success', 'تم التبرع بنجاح، شكراً لك!');
    }
}
