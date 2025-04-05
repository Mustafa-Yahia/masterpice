@extends('layouts.app')

@section('content')
    <section class="donation-confirmation-section" style="padding: 50px 0; background-color: #f9f9f9; direction: rtl;">
        <div class="auto-container">
            <!-- Step 1: Title -->
            <div class="sec-title centered" style="text-align: right; margin-bottom: 30px;">
                <h2 style="font-size: 36px; color: #25282a; font-weight: 700;">
                    <i class="fas fa-check-circle" style="color: #3cc88f; margin-left: 10px;"></i>
                    تأكيد التبرع - {{ $category->title }}
                </h2>
                <p style="font-size: 18px; color: #555; text-align: right;">
                    قم بإتمام عملية التبرع الآن باستخدام طريقة الدفع التي تفضلها.
                </p>
            </div>

            <!-- Step 2: Donation Details -->
            <div class="confirmation-details" style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

                <!-- جدول البيانات -->
                <table style="width: 100%; border-collapse: collapse; font-size: 18px;">
                    <thead>
                        <tr>
                            <th style="text-align: right; padding: 10px; font-weight: 600;">التفاصيل</th>
                            <th style="text-align: right; padding: 10px; font-weight: 600;">القيمة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- مبلغ التبرع -->
                        <tr>
                            <td style="text-align: right; padding: 10px;">
                                <i class="fas fa-money-bill-wave" style="color: #3cc88f; margin-left: 10px;"></i>
                                <strong>المبلغ المطلوب:</strong>
                            </td>
                            <td style="text-align: right; padding: 10px;">
                                {{ $amount }} {{ $currency == 'USD' ? 'دولار أمريكي' : 'دينار أردني' }}
                            </td>
                        </tr>
                        <!-- عدد الأفراد -->
                        <tr>
                            <td style="text-align: right; padding: 10px;">
                                <i class="fas fa-users" style="color: #3cc88f; margin-left: 10px;"></i>
                                <strong>عدد الأفراد:</strong>
                            </td>
                            <td style="text-align: right; padding: 10px;">
                                {{ $peopleCount }}
                            </td>
                        </tr>
                        <!-- المبلغ لكل شخص -->
                        <tr>
                            <td style="text-align: right; padding: 10px;">
                                <i class="fas fa-user-tag" style="color: #3cc88f; margin-left: 10px;"></i>
                                <strong>المبلغ لكل شخص:</strong>
                            </td>
                            <td style="text-align: right; padding: 10px;">
                                @php
                                    $amountPerPerson = $amount / $peopleCount;
                                @endphp
                                {{ number_format($amountPerPerson, 2) }} {{ $currency == 'USD' ? 'دولار أمريكي' : 'دينار أردني' }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Step 3: Payment Methods -->
                <p style="text-align: right; font-size: 18px; margin-bottom: 20px;">
                    <strong><i class="fas fa-credit-card" style="color: #3cc88f; margin-left: 10px;"></i> طريقة الدفع:</strong>
                </p>
                <div class="payment-methods" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                    <!-- PayPal Option -->
                    <div style="flex: 1; text-align: right; padding: 10px; border: 1px solid #ddd; border-radius: 8px; transition: transform 0.3s;">
                        <input type="radio" id="paypal" name="payment_method" value="paypal" checked onclick="togglePaymentForm('paypal')">
                        <label for="paypal" style="font-size: 16px; color: #25282a;">
                            <i class="fab fa-paypal" style="margin-left: 10px; color: #3cc88f;"></i> PayPal
                        </label>
                    </div>
                    <!-- Credit Card Option -->
                    <div style="flex: 1; text-align: right; padding: 10px; border: 1px solid #ddd; border-radius: 8px; transition: transform 0.3s;">
                        <input type="radio" id="credit_card" name="payment_method" value="credit_card" onclick="togglePaymentForm('credit_card')">
                        <label for="credit_card" style="font-size: 16px; color: #25282a;">
                            <i class="fas fa-credit-card" style="margin-left: 10px; color: #3cc88f;"></i> بطاقة ائتمان
                        </label>
                    </div>
                </div>

                <!-- Step 4: Payment Forms -->
                <!-- PayPal Form -->
                <div id="paypal-form" style="display: block; padding: 15px; background: #f5f5f5; border-radius: 10px; margin-bottom: 20px;">
                    <label for="paypal_email" style="font-size: 16px; color: #25282a;">البريد الإلكتروني لـ PayPal</label>
                    <input type="email" name="paypal_email" id="paypal_email" placeholder="البريد الإلكتروني لـ PayPal" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;">
                </div>

                <!-- Credit Card Form -->
                <div id="credit-card-form" style="display: none; padding: 15px; background: #f5f5f5; border-radius: 10px; margin-bottom: 20px;">
                    <label for="credit_card_name" style="font-size: 16px; color: #25282a;">اسم حامل البطاقة</label>
                    <input type="text" name="credit_card_name" id="credit_card_name" placeholder="اسم حامل البطاقة" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;">

                    <label for="credit_card_number" style="font-size: 16px; color: #25282a;">رقم البطاقة</label>
                    <input type="text" name="credit_card_number" id="credit_card_number" placeholder="رقم البطاقة" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;" oninput="validateCardNumber(this)">

                    <label for="credit_card_expiry" style="font-size: 16px; color: #25282a;">تاريخ الانتهاء</label>
                    <input type="text" name="credit_card_expiry" id="credit_card_expiry" placeholder="MM/YY" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;">

                    <label for="credit_card_cvc" style="font-size: 16px; color: #25282a;">رمز الأمان (CVC)</label>
                    <input type="text" name="credit_card_cvc" id="credit_card_cvc" placeholder="رمز الأمان" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;">

                    <!-- Icon and Card Type Display -->
                    <div id="card-info" style="text-align: right; margin-top: 10px; font-size: 16px;">
                        <span id="card-type" style="color: #25282a;"></span>
                    </div>
                </div>

                <!-- Step 5: Submit Button -->
                <button type="submit" class="theme-btn btn-style-one" id="donate-btn" style="background-color: #3cc88f; color: #fff; border-radius: 8px; padding: 12px 30px; font-size: 16px; text-align: right; transition: background-color 0.3s;">
                    <span class="btn-title"><i class="fas fa-hand-holding-usd" style="margin-left: 10px;"></i> إتمام التبرع</span>
                </button>
            </div>
        </div>
    </section>

    <script>
        // إظهار النموذج المناسب بناءً على طريقة الدفع المختارة
        function togglePaymentForm(paymentMethod) {
            if (paymentMethod === 'paypal') {
                document.getElementById('paypal-form').style.display = 'block';
                document.getElementById('credit-card-form').style.display = 'none';
            } else if (paymentMethod === 'credit_card') {
                document.getElementById('paypal-form').style.display = 'none';
                document.getElementById('credit-card-form').style.display = 'block';
            }
        }

        // التحقق من نوع البطاقة عند إدخال رقم البطاقة
        function validateCardNumber(input) {
            var cardNumber = input.value.replace(/\D/g, '');
            var cardType = '';

            // تحقق من نوع البطاقة
            if (/^4[0-9]{12}(?:[0-9]{3})?$/.test(cardNumber)) {
                cardType = 'فيزا';
            } else if (/^5[1-5][0-9]{14}$/.test(cardNumber)) {
                cardType = 'ماستركارد';
            }

            if (isValidCardNumber(cardNumber)) {
                document.getElementById('card-type').innerText = cardType ? `نوع البطاقة: ${cardType}` : 'نوع البطاقة غير معروف';
                document.getElementById('donate-btn').disabled = false; // تمكين زر التبرع
            } else {
                document.getElementById('card-type').innerText = 'رقم البطاقة غير صالح';
                document.getElementById('donate-btn').disabled = true; // تعطيل زر التبرع
            }
        }

        // التحقق من صحة رقم البطاقة باستخدام خوارزمية Luhn
        function isValidCardNumber(cardNumber) {
            var sum = 0;
            var shouldDouble = false;

            for (var i = cardNumber.length - 1; i >= 0; i--) {
                var digit = parseInt(cardNumber.charAt(i));

                if (shouldDouble) {
                    digit *= 2;
                    if (digit > 9) digit -= 9;
                }

                sum += digit;
                shouldDouble = !shouldDouble;
            }

            return sum % 10 === 0;
        }
    </script>

    <style>
        /* تحسينات على الأزرار والنماذج */
        #donate-btn:not([disabled]):hover {
            background-color: #2ab76c; /* تغيير اللون عند التمرير */
            cursor: pointer; /* يظهر كـ pointer عند التمرير */
        }

        /* عند تعطيل الزر */
        #donate-btn[disabled]:hover {
            background-color: #3cc88f; /* نفس اللون عند التمرير */
            cursor: not-allowed; /* تغيير الشكل إلى not-allowed عند التمرير */
        }

        /* إضافة تأثير عند التمرير على الحقول */
        .form-group input[type="radio"]:hover {
            cursor: pointer;
        }

        /* تحسين تباعد النصوص */
        .confirmation-details p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .sec-title h2 {
            font-size: 36px;
            color: #25282a;
            font-weight: 700;
        }

        /* تحسين الجدول */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f5f5f5;
            color: #25282a;
        }
    </style>
@endsection

