@extends('layouts.app')

@section('content')
    <section class="donation-confirmation-section" style="padding: 50px 0; background-color: #f9f9f9;">
        <div class="auto-container">
            <div class="sec-title centered" style="text-align: right;">
                <h2 style="font-size: 36px; color: #25282a; font-weight: 700;">تأكيد التبرع</h2>
            </div>

            <div class="confirmation-details" style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <p><strong>المبلغ المطلوب: </strong> {{ $amount }} دينار أردني</p>
                <p><strong>عدد الأفراد: </strong> {{ $peopleCount }}</p>
                <p><strong>المبلغ الإجمالي: </strong> {{ $totalAmount }} دينار أردني</p>
                <p><strong>طريقة الدفع:</strong></p>
                <form action="{{ route('donation.payment') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="radio" id="paypal" name="payment_method" value="paypal" checked>
                        <label for="paypal">PayPal</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" id="credit_card" name="payment_method" value="credit_card">
                        <label for="credit_card">بطاقة ائتمان</label>
                    </div>
                    <button type="submit" class="theme-btn btn-style-one" style="background-color: #3cc88f; color: #fff; border-radius: 8px; padding: 12px 30px; font-size: 16px;">
                        <span class="btn-title">إتمام التبرع</span>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
