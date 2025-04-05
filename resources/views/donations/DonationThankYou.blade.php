// صفحة thank-you.blade.php
@extends('layouts.app')

@section('content')
    <section class="thank-you-section" style="padding: 50px 0; background-color: #f9f9f9; direction: rtl;">
        <div class="auto-container">
            <div class="sec-title centered" style="text-align: right;">
                <h2 style="font-size: 36px; color: #25282a; font-weight: 700;">
                    <i class="fas fa-check-circle" style="color: #3cc88f; margin-left: 10px;"></i>
                    شكراً لتبرعك
                </h2>
                <p style="font-size: 18px; color: #555; text-align: right;">
                    تم استلام تبرعك بنجاح. شكراً لمساعدتك في دعم قضيتنا!
                </p>
            </div>

            <div class="thank-you-details" style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); text-align: right;">
                <p style="font-size: 18px;">
                    <strong>المبلغ المدفوع:</strong> {{ $donation->amount }} {{ $donation->currency == 'USD' ? 'دولار أمريكي' : 'دينار أردني' }}
                </p>
                <p style="font-size: 18px;">
                    <strong>طريقة الدفع:</strong> {{ $donation->payment_method == 'paypal' ? 'PayPal' : 'بطاقة ائتمان' }}
                </p>
                <p style="font-size: 18px;">
                    <strong>عدد الأفراد:</strong> {{ $donation->people_count }}
                </p>
            </div>

            <!-- زر العودة إلى الصفحة الرئيسية -->
            <a href="{{ route('home') }}" class="theme-btn btn-style-one" style="background-color: #3cc88f; color: #fff; border-radius: 8px; padding: 12px 30px; font-size: 16px;">
                العودة إلى الصفحة الرئيسية
            </a>
        </div>
    </section>
@endsection
