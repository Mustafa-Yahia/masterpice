@extends('layouts.app')

@section('content')
    <section class="thank-you-section" style="padding: 50px 0; background-color: #f9f9f9; direction: rtl;">
        <div class="auto-container">
            <!-- Step 1: Title -->
            <div class="sec-title centered" style="text-align: right; margin-bottom: 30px;">
                <h2 style="font-size: 36px; color: #25282a; font-weight: 700;">
                    <i class="fas fa-check-circle" style="color: #3cc88f; margin-left: 10px;"></i>
                    شكراً لتبرعك
                </h2>
                <p style="font-size: 18px; color: #555; text-align: right;">
                    تم إتمام عملية التبرع بنجاح. نحن ممتنون لدعمك!
                </p>
            </div>

            <!-- Step 2: Donation Details -->
            <div class="confirmation-details" style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <h3 style="font-size: 24px; color: #25282a; font-weight: 600; text-align: right;">
                    تفاصيل التبرع
                </h3>
                <table style="width: 100%; border-collapse: collapse; font-size: 18px; margin-top: 20px;">
                    <thead>
                        <tr>
                            <th style="text-align: right; padding: 10px; font-weight: 600;">التفاصيل</th>
                            <th style="text-align: right; padding: 10px; font-weight: 600;">القيمة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: right; padding: 10px;">
                                <i class="fas fa-money-bill-wave" style="color: #3cc88f; margin-left: 10px;"></i>
                                <strong>المبلغ:</strong>
                            </td>
                            <td style="text-align: right; padding: 10px;">
                                {{ number_format($donation->amount, 2) }} {{ $donation->currency == 'USD' ? 'دولار أمريكي' : 'دينار أردني' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 10px;">
                                <i class="fas fa-users" style="color: #3cc88f; margin-left: 10px;"></i>
                                <strong>عدد الأفراد:</strong>
                            </td>
                            <td style="text-align: right; padding: 10px;">
                                {{ $donation->peopleCount }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 10px;">
                                <i class="fas fa-user-tag" style="color: #3cc88f; margin-left: 10px;"></i>
                                <strong>المبلغ لكل شخص:</strong>
                            </td>
                            <td style="text-align: right; padding: 10px;">
                                {{ number_format($donation->amountPerPerson, 2) }} {{ $donation->currency == 'USD' ? 'دولار أمريكي' : 'دينار أردني' }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Step 3: Payment Method -->
                <p style="font-size: 18px; color: #555; text-align: right; margin-top: 20px;">
                    <strong><i class="fas fa-credit-card" style="color: #3cc88f; margin-left: 10px;"></i> طريقة الدفع:</strong>
                    <span>{{ $donation->payment_method == 'paypal' ? 'PayPal' : 'بطاقة ائتمان' }}</span>
                </p>

                @if($donation->payment_method == 'paypal')
                    <p style="font-size: 18px; color: #555; text-align: right;">
                        <strong><i class="fab fa-paypal" style="color: #3cc88f;"></i> البريد الإلكتروني لـ PayPal:</strong>
                        <span>{{ $donation->paypal_email }}</span>
                    </p>
                @elseif($donation->payment_method == 'credit_card')
                    <p style="font-size: 18px; color: #555; text-align: right;">
                        <strong><i class="fas fa-credit-card" style="color: #3cc88f;"></i> اسم حامل البطاقة:</strong>
                        <span>{{ $donation->credit_card_name }}</span>
                    </p>
                @endif
            </div>

            <!-- Step 4: Final Thank You Message -->
            <div class="thank-you-message" style="text-align: center; margin-top: 30px;">
                <h3 style="font-size: 24px; color: #25282a; font-weight: 600;">
                    شكراً مرة أخرى على تبرعك الكريم!
                </h3>
                <p style="font-size: 18px; color: #555; text-align: center;">
                    نحن ممتنون لدعمك وسوف نستخدم تبرعك في تحسين خدماتنا ومساعدة المحتاجين.
                </p>
            </div>
        </div>
    </section>
@endsection




{{-- // صفحة thank-you.blade.php
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
@endsection --}}
