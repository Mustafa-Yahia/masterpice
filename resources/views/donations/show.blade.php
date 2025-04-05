@extends('layouts.app')

@section('content')
    <section class="donation-detail-section" style="padding: 50px 0; background-color: #f9f9f9;">
        <div class="auto-container">
            <div class="sec-title centered" style="text-align: right;">
                <div class="sub-title" style="font-size: 18px; color: #3cc88f; font-weight: 600;">تفاصيل التبرع</div>
                <h2 style="font-size: 36px; color: #25282a; font-weight: 700;">{{ $category->title }}</h2>
            </div>

            <div class="row clearfix">
                <!-- Image Box -->
                <div class="col-lg-6">
                    <div class="image-box">
                        <img src="{{ asset('storage/images/' . $category->image) }}" alt="{{ $category->title }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
                    </div>
                </div>

                <!-- Donation Form -->
                <div class="col-lg-6">
                    <div class="detail-content" style="background-color: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); text-align: right;">
                        <p style="font-size: 16px; color: #555; text-align: right;">{{ $category->description }}</p>
                        <div class="amount" style="font-size: 18px; font-weight: 600; color: #3cc88f; text-align: right;">
                            <strong>المبلغ المطلوب: </strong>
                            <span>{{ $category->amount }} دينار أردني لكل فرد</span>
                        </div>

                        <!-- Donation Form -->
                        <form method="POST" action="{{ route('donation.confirm') }}" id="donation-form" style="text-align: right;">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <input type="hidden" name="amount" id="amount">
                            <input type="hidden" name="people_count" id="people-count">
                            <!-- Hidden input to store total amount -->
                            <input type="hidden" name="total_amount" id="total-amount-hidden">
                            <input type="hidden" name="currency" id="currency">

                            <!-- Number of People and Amount in a Single Line -->
                            <div class="form-group" style="margin-bottom: 20px; display: flex; align-items: center; justify-content: flex-start;">
                                <div class="input-group" style="width: 150px; direction: rtl; top:20px">
                                    <button type="button" class="btn btn-secondary" id="decrement" style="font-size: 20px; width: 35px;">-</button>
                                    <input type="number" id="people-count-visible" class="form-control" value="1" min="1" style="font-size: 16px; text-align: center; width: 60px;">
                                    <button type="button" class="btn btn-secondary" id="increment" style="font-size: 20px; width: 35px;">+</button>
                                </div>

                                <div style="margin-left: 15px; flex-grow: 1;">
                                    <label for="amount" style="font-weight: 600; color: #25282a; text-align: right;">المبلغ الذي ترغب في التبرع به (يدويًا):</label>
                                    <input type="text" name="amount" id="amount-manual" class="form-control" placeholder="أدخل المبلغ" required style="border-radius: 8px; padding: 10px; font-size: 16px; text-align: right;">
                                    <span id="amount-error" style="color: red; display: none;">المبلغ يجب أن يكون مساوياً أو أكبر من {{ $category->amount }} دينار أردني</span>
                                </div>
                            </div>

                            <!-- Total Amount (Auto-calculated) -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="total-amount" style="font-weight: 600; color: #25282a; text-align: right;">المبلغ الإجمالي:</label>
                                <input type="text" id="total-amount" class="form-control" readonly style="border-radius: 8px; padding: 10px; font-size: 16px; background-color: #f1f1f1; text-align: right;">
                            </div>

                            <!-- Currency Selection using Radio Buttons -->
                            <div class="form-group mb-4" dir="rtl">
                                <label style="font-weight: 600; color: #25282a; display: block; margin-bottom: 10px;">العملة:</label>
                                <div style="display: flex; gap: 30px;">
                                    <div class="form-check" style="display: flex; flex-direction: row-reverse; align-items: center; gap: 10px;">
                                        <input type="radio" class="form-check-input" id="currencyJOD" name="currency" value="JOD" checked>
                                        <label class="form-check-label" for="currencyJOD" style="font-size: 16px; color: #25282a;">دينار أردني</label>
                                    </div>
                                    <div class="form-check" style="display: flex; flex-direction: row-reverse; align-items: center; gap: 10px;">
                                        <input type="radio" class="form-check-input" id="currencyUSD" name="currency" value="USD">
                                        <label class="form-check-label" for="currencyUSD" style="font-size: 16px; color: #25282a;">دولار أمريكي</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="theme-btn btn-style-one" id="donate-btn" style="background-color: #3cc88f; color: #fff; border-radius: 8px; padding: 12px 30px; font-size: 16px; text-align: right;" disabled>
                                <span class="btn-title">تبرع الآن</span>
                            </button>
                        </form>

                        <script>
                            var individualAmount = {{ $category->amount }}; // المبلغ المطلوب لكل شخص
                            var peopleCount = 1; // عدد الأشخاص الافتراضي
                            var exchangeRate = 1.4; // سعر الصرف الافتراضي من دينار أردني إلى دولار أمريكي (سيتم تحديثه باستخدام API)

                            // دالة لجلب سعر الصرف من API
                            function getExchangeRate() {
                                // رابط API لسعر الصرف مع مفتاح API الخاص بك
                                var apiUrl = `https://v6.exchangerate-api.com/v6/b4b461a3bd68563d6aa30ea2/latest/JOD`; // استبدل بـ YOUR_API_KEY في مكان المفتاح

                                // استخدام Fetch لجلب البيانات من API
                                fetch(apiUrl)
                                    .then(response => response.json())
                                    .then(data => {
                                        // استخراج سعر الصرف من البيانات
                                        if (data.result === 'success') {
                                            exchangeRate = data.conversion_rates.USD; // الحصول على سعر الصرف بين الدينار الأردني والدولار الأمريكي
                                            console.log('Exchange rate:', exchangeRate);
                                            updateTotalAmount(); // تحديث المبلغ الإجمالي بعد جلب سعر الصرف
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching exchange rate:', error);
                                    });
                            }

                            // دالة لتحديث المبلغ الإجمالي بناءً على عدد الأشخاص
                            function updateTotalAmount() {
                                var totalAmount = peopleCount * individualAmount;
                                var currency = document.getElementById('currency').value;

                                // إذا كانت العملة دولار أمريكي، يجب ضرب المبلغ في سعر الصرف
                                if (currency === 'USD') {
                                    totalAmount = totalAmount * exchangeRate; // ضرب المبلغ في سعر الصرف لتحويله من دينار إلى دولار
                                }

                                // عرض المبلغ الإجمالي في الحقل مع العملة (USD أو JOD)
                                var currencySymbol = (currency === 'USD') ? 'USD' : 'JOD';
                                document.getElementById('total-amount').value = totalAmount.toFixed(2) + ' ' + currencySymbol; // عرض المبلغ مع العملة

                                // تحديث الحقل المخفي
                                document.getElementById('total-amount-hidden').value = totalAmount.toFixed(2); // تحديث المبلغ المخفي
                                document.getElementById('amount').value = individualAmount; // تحديث المبلغ المخفي
                                document.getElementById('people-count').value = peopleCount; // تحديث عدد الأشخاص المخفي
                                document.getElementById('people-count-visible').value = peopleCount; // تحديث عدد الأشخاص المرئي
                            }

                            // التحقق من المبلغ المدخل يدويًا
                            document.getElementById('amount-manual').addEventListener('input', function() {
                                var manualAmount = parseFloat(document.getElementById('amount-manual').value);
                                var minAmount = individualAmount;

                                // إذا كانت العملة دولار أمريكي، يجب ضرب الحد الأدنى بالـ exchangeRate
                                if (document.getElementById('currency').value === 'USD') {
                                    minAmount = individualAmount * exchangeRate;
                                }

                                if (manualAmount < minAmount) {
                                    document.getElementById('amount-error').style.display = 'inline'; // إظهار رسالة الخطأ
                                    document.getElementById('donate-btn').disabled = true; // تعطيل زر التبرع
                                } else {
                                    document.getElementById('amount-error').style.display = 'none'; // إخفاء رسالة الخطأ
                                    document.getElementById('donate-btn').disabled = false; // تفعيل زر التبرع
                                }
                            });

                            // تحديث العملة بناءً على الاختيار
                            document.getElementById('currencyJOD').addEventListener('change', function() {
                                document.getElementById('currency').value = 'JOD';
                                updateTotalAmount();
                            });

                            document.getElementById('currencyUSD').addEventListener('change', function() {
                                document.getElementById('currency').value = 'USD';
                                updateTotalAmount();
                            });

                            // زيادة عدد الأشخاص
                            document.getElementById('increment').addEventListener('click', function() {
                                peopleCount++;
                                updateTotalAmount();
                            });

                            // تقليل عدد الأشخاص
                            document.getElementById('decrement').addEventListener('click', function() {
                                if (peopleCount > 1) {
                                    peopleCount--;
                                    updateTotalAmount();
                                }
                            });

                            updateTotalAmount();

                            getExchangeRate();
                        </script>
    <style>
        /* عند تفعيل الزر */
        #donate-btn:not([disabled]):hover {
            background-color: #2ab76c; /* تغيير اللون عند التمرير */
            cursor: pointer; /* يظهر كـ pointer عند التمرير */
        }

        /* عند تعطيل الزر */
        #donate-btn[disabled]:hover {
            background-color: #3cc88f; /* نفس اللون عند التمرير */
            cursor: not-allowed; /* تغيير الشكل إلى not-allowed عند التمرير */
        }
    </style>
@endsection

{{--

@extends('layouts.app')

@section('content')
    <section class="donation-detail-section" style="padding: 50px 0; background-color: #f9f9f9;">
        <div class="auto-container">
            <div class="sec-title centered" style="text-align: right;">
                <div class="sub-title" style="font-size: 18px; color: #3cc88f; font-weight: 600;">تفاصيل التبرع</div>
                <h2 style="font-size: 36px; color: #25282a; font-weight: 700;">{{ $category->title }}</h2>
            </div>

            <div class="row clearfix">
                <!-- Image Box -->
                <div class="col-lg-6">
                    <div class="image-box">
                        <img src="{{ asset('storage/images/' . $category->image) }}" alt="{{ $category->title }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
                    </div>
                </div>

                <!-- Donation Form -->
                <div class="col-lg-6">
                    <div class="detail-content" style="background-color: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); text-align: right;">
                        <p style="font-size: 16px; color: #555; text-align: right;">{{ $category->description }}</p>
                        <div class="amount" style="font-size: 18px; font-weight: 600; color: #3cc88f; text-align: right;">
                            <strong>المبلغ المطلوب: </strong>
                            <span>{{ $category->amount }} دينار أردني لكل فرد</span>
                        </div>

                        <!-- Donation Form -->
                        <form method="POST" action="{{ route('donation.confirm') }}" id="donation-form" style="text-align: right;">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <input type="hidden" name="amount" id="amount">
                            <input type="hidden" name="people_count" id="people-count">
                            <!-- Hidden input to store total amount -->
                            <input type="hidden" name="total_amount" id="total-amount-hidden">
                            <input type="hidden" name="currency" id="currency">

                            <!-- Number of People and Amount in a Single Line -->
                            <div class="form-group" style="margin-bottom: 20px; display: flex; align-items: center; justify-content: flex-start;">
                                <div class="input-group" style="width: 150px; direction: rtl; top:20px">
                                    <button type="button" class="btn btn-secondary" id="decrement" style="font-size: 20px; width: 35px;">-</button>
                                    <input type="number" id="people-count-visible" class="form-control" value="1" min="1" style="font-size: 16px; text-align: center; width: 60px;">
                                    <button type="button" class="btn btn-secondary" id="increment" style="font-size: 20px; width: 35px;">+</button>
                                </div>

                                <div style="margin-left: 15px; flex-grow: 1;">
                                    <label for="amount" style="font-weight: 600; color: #25282a; text-align: right;">المبلغ الذي ترغب في التبرع به (يدويًا):</label>
                                    <input type="text" name="amount" id="amount-manual" class="form-control" placeholder="أدخل المبلغ" required style="border-radius: 8px; padding: 10px; font-size: 16px; text-align: right;">
                                    <span id="amount-error" style="color: red; display: none;">المبلغ يجب أن يكون مساوياً أو أكبر من {{ $category->amount }} دينار أردني</span>
                                </div>
                            </div>

                            <!-- Total Amount (Auto-calculated) -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="total-amount" style="font-weight: 600; color: #25282a; text-align: right;">المبلغ الإجمالي:</label>
                                <input type="text" id="total-amount" class="form-control" readonly style="border-radius: 8px; padding: 10px; font-size: 16px; background-color: #f1f1f1; text-align: right;">
                            </div>

                            <!-- Currency Selection using Radio Buttons -->
                            <div class="form-group mb-4" dir="rtl">
                                <label style="font-weight: 600; color: #25282a; display: block; margin-bottom: 10px;">العملة:</label>
                                <div style="display: flex; gap: 30px;">
                                    <div class="form-check" style="display: flex; flex-direction: row-reverse; align-items: center; gap: 10px;">
                                        <input type="radio" class="form-check-input" id="currencyJOD" name="currency" value="JOD" checked>
                                        <label class="form-check-label" for="currencyJOD" style="font-size: 16px; color: #25282a;">دينار أردني</label>
                                    </div>
                                    <div class="form-check" style="display: flex; flex-direction: row-reverse; align-items: center; gap: 10px;">
                                        <input type="radio" class="form-check-input" id="currencyUSD" name="currency" value="USD">
                                        <label class="form-check-label" for="currencyUSD" style="font-size: 16px; color: #25282a;">دولار أمريكي</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="theme-btn btn-style-one" id="donate-btn" style="background-color: #3cc88f; color: #fff; border-radius: 8px; padding: 12px 30px; font-size: 16px; text-align: right;" disabled>
                                <span class="btn-title">تبرع الآن</span>
                            </button>
                        </form>

                        <script>
                            var individualAmount = {{ $category->amount }}; // المبلغ المطلوب لكل شخص
                            var peopleCount = 1; // عدد الأشخاص الافتراضي
                            var exchangeRate = 1.4; // سعر الصرف الافتراضي من دينار أردني إلى دولار أمريكي (سيتم تحديثه باستخدام API)

                            // دالة لجلب سعر الصرف من API
                            function getExchangeRate() {
                                // رابط API لسعر الصرف مع مفتاح API الخاص بك
                                var apiUrl = `https://v6.exchangerate-api.com/v6/b4b461a3bd68563d6aa30ea2/latest/JOD`; // استبدل بـ YOUR_API_KEY في مكان المفتاح

                                // استخدام Fetch لجلب البيانات من API
                                fetch(apiUrl)
                                    .then(response => response.json())
                                    .then(data => {
                                        // استخراج سعر الصرف من البيانات
                                        if (data.result === 'success') {
                                            exchangeRate = data.conversion_rates.USD; // الحصول على سعر الصرف بين الدينار الأردني والدولار الأمريكي
                                            console.log('Exchange rate:', exchangeRate);
                                            updateTotalAmount(); // تحديث المبلغ الإجمالي بعد جلب سعر الصرف
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching exchange rate:', error);
                                    });
                            }

                            // دالة لتحديث المبلغ الإجمالي بناءً على عدد الأشخاص
                            function updateTotalAmount() {
                                var totalAmount = peopleCount * individualAmount;
                                var currency = document.getElementById('currency').value;

                                // إذا كانت العملة دولار أمريكي، يجب ضرب المبلغ في سعر الصرف
                                if (currency === 'USD') {
                                    totalAmount = totalAmount * exchangeRate; // ضرب المبلغ في سعر الصرف لتحويله من دينار إلى دولار
                                }

                                // عرض المبلغ الإجمالي في الحقل مع العملة (USD أو JOD)
                                var currencySymbol = (currency === 'USD') ? 'USD' : 'JOD';
                                document.getElementById('total-amount').value = totalAmount.toFixed(2) + ' ' + currencySymbol; // عرض المبلغ مع العملة

                                // تحديث الحقل المخفي
                                document.getElementById('total-amount-hidden').value = totalAmount.toFixed(2); // تحديث المبلغ المخفي
                                document.getElementById('amount').value = individualAmount; // تحديث المبلغ المخفي
                                document.getElementById('people-count').value = peopleCount; // تحديث عدد الأشخاص المخفي
                                document.getElementById('people-count-visible').value = peopleCount; // تحديث عدد الأشخاص المرئي
                            }

                            // التحقق من المبلغ المدخل يدويًا
                            document.getElementById('amount-manual').addEventListener('input', function() {
                                var manualAmount = parseFloat(document.getElementById('amount-manual').value);
                                if (manualAmount < individualAmount) {
                                    document.getElementById('amount-error').style.display = 'inline'; // إظهار رسالة الخطأ
                                    document.getElementById('donate-btn').disabled = true; // تعطيل زر التبرع
                                } else {
                                    document.getElementById('amount-error').style.display = 'none'; // إخفاء رسالة الخطأ
                                    document.getElementById('donate-btn').disabled = false; // تفعيل زر التبرع
                                }
                            });

                            // تحديث العملة بناءً على الاختيار
                            document.getElementById('currencyJOD').addEventListener('change', function() {
                                document.getElementById('currency').value = 'JOD';
                                updateTotalAmount();
                            });

                            document.getElementById('currencyUSD').addEventListener('change', function() {
                                document.getElementById('currency').value = 'USD';
                                updateTotalAmount();
                            });

                            // زيادة عدد الأشخاص
                            document.getElementById('increment').addEventListener('click', function() {
                                peopleCount++;
                                updateTotalAmount();
                            });

                            // تقليل عدد الأشخاص
                            document.getElementById('decrement').addEventListener('click', function() {
                                if (peopleCount > 1) {
                                    peopleCount--;
                                    updateTotalAmount();
                                }
                            });

                            updateTotalAmount();

                            getExchangeRate();
                        </script>
    <style>
        /* عند تفعيل الزر */
        #donate-btn:not([disabled]):hover {
            background-color: #2ab76c; /* تغيير اللون عند التمرير */
            cursor: pointer; /* يظهر كـ pointer عند التمرير */
        }

        /* عند تعطيل الزر */
        #donate-btn[disabled]:hover {
            background-color: #3cc88f; /* نفس اللون عند التمرير */
            cursor: not-allowed; /* تغيير الشكل إلى not-allowed عند التمرير */
        }
    </style>





@endsection --}}
