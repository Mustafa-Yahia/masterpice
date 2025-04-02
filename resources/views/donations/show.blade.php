<!-- resources/views/donation/show.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- Donation Category Detail Section -->
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
                        <form method="POST" action="{{ route('donation.process', $category->id) }}" id="donation-form" style="text-align: right;">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $category->id }}">

                            <!-- Number of People and Amount in a Single Line -->
                            <div class="form-group" style="margin-bottom: 20px; display: flex; align-items: center; justify-content: flex-start;">
                                <!-- People Count (on left side of amount field) -->
                                <div class="input-group" style="width: 150px; direction: rtl; top:20px">
                                    <button type="button" class="btn btn-secondary" id="decrement" style="font-size: 20px; width: 35px;">-</button>
                                    <input type="number" id="people-count" class="form-control" value="1" min="1" style="font-size: 16px; text-align: center; width: 60px;">
                                    <button type="button" class="btn btn-secondary" id="increment" style="font-size: 20px; width: 35px;">+</button>
                                </div>

                                <!-- Amount Field (on the right side) -->
                                <div style="margin-left: 15px; flex-grow: 1;">
                                    <label for="amount" style="font-weight: 600; color: #25282a; text-align: right;">المبلغ الذي ترغب في التبرع به (يدويًا):</label>
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="أدخل المبلغ" required style="border-radius: 8px; padding: 10px; font-size: 16px; text-align: right;">
                                </div>
                            </div>

                            <!-- Total Amount (Auto-calculated) -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="total-amount" style="font-weight: 600; color: #25282a; text-align: right;">المبلغ الإجمالي:</label>
                                <input type="text" id="total-amount" class="form-control" readonly style="border-radius: 8px; padding: 10px; font-size: 16px; background-color: #f1f1f1; text-align: right;">
                            </div>

                            <!-- Currency Selection using Radio Buttons -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label style="font-weight: 600; color: #25282a; text-align: right;">العملة:</label>
                                <div class="form-check" style="display: inline-block; margin-right: 20px;">
                                    <input type="radio" class="form-check-input" id="currencyJOD" name="currency" value="JOD" checked>
                                    <label class="form-check-label" for="currencyJOD" style="font-size: 16px; color: #25282a; text-align: right;">دينار أردني</label>
                                </div>
                                <div class="form-check" style="display: inline-block;">
                                    <input type="radio" class="form-check-input" id="currencyUSD" name="currency" value="USD">
                                    <label class="form-check-label" for="currencyUSD" style="font-size: 16px; color: #25282a; text-align: right;">دولار أمريكي</label>
                                </div>
                            </div>

                            <!-- Payment Status -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="payment_status" style="font-weight: 600; color: #25282a; text-align: right;">حالة الدفع:</label>
                                <select name="payment_status" id="payment_status" class="form-control" required style="border-radius: 8px; padding: 10px; font-size: 16px;">
                                    <option value="pending">معلق</option>
                                    <option value="completed">مكتمل</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="theme-btn btn-style-one" style="background-color: #3cc88f; color: #fff; border-radius: 8px; padding: 12px 30px; font-size: 16px; text-align: right;">
                                <span class="btn-title">تبرع الآن</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS to handle number of people and total amount calculation -->
    <script>
        // Initialize values
        var individualAmount = {{ $category->amount }}; // Amount for each individual
        var peopleCount = 1; // Default people count
        var currencyRate = 1; // Initial currency rate for JOD
        var currencyType = 'JOD'; // Initial currency type

        // Update total amount
        function updateTotalAmount() {
            var totalAmount = peopleCount * individualAmount * currencyRate;
            document.getElementById('total-amount').value = totalAmount.toFixed(2) + ' ' + currencyType;
        }

        // Increment and Decrement buttons for people count
        document.getElementById('increment').addEventListener('click', function() {
            peopleCount++;
            document.getElementById('people-count').value = peopleCount;
            updateTotalAmount();
        });

        document.getElementById('decrement').addEventListener('click', function() {
            if (peopleCount > 1) {
                peopleCount--;
                document.getElementById('people-count').value = peopleCount;
                updateTotalAmount();
            }
        });

        // Currency change logic
        document.getElementById('currencyJOD').addEventListener('change', function() {
            currencyType = 'JOD';
            currencyRate = 1; // 1 JOD = 1 JOD
            updateTotalAmount();
        });

        document.getElementById('currencyUSD').addEventListener('change', function() {
            currencyType = 'USD';
            currencyRate = 1.41; // Example conversion rate, 1 JOD = 1.41 USD
            updateTotalAmount();
        });

        // Initialize the total amount on page load
        updateTotalAmount();
    </script>

@endsection



{{-- @extends('layouts.app')

@section('content')
<section class="donation-details" style="direction: rtl; text-align: right;">
    <div class="auto-container">
        <!-- عنوان الصفحة -->
        <div class="sec-title centered">
            <h2 class="fw-bold" style="color: #3cc88f;">{{ $category->title }}</h2>
            <div class="text" style="color: #555; font-size: 18px;">{{ $category->description }}</div>
        </div>


    <!-- اختيار مبلغ التبرع -->
    <div class="donation-amounts mt-5 p-4 rounded shadow-sm" style="background: #f8f9fa; max-width: 700px; margin: auto;">
        <h3 class="fw-semibold text-center mb-4">اختر قيمة التبرع:</h3>
        <form action="{{ route('donation.process', $category->id) }}" method="POST">
            @csrf

            @if ($category->type === 'fixed')
                <!-- عرض المبلغ الثابت فقط -->
                <div class="form-group text-center">
                    <h4 class="fw-bold text-success">${{ number_format($category->amount, 2) }}</h4>
                    <input type="hidden" name="amount" value="{{ $category->amount }}">
                    <input type="hidden" name="type" value="fixed">
                </div>

            @elseif ($category->type === 'custom')
                <!-- إدخال مبلغ مخصص -->
                <div class="input-group my-3">
                    <input type="number" name="amount" class="form-control" placeholder="أدخل المبلغ" min="1" step="0.01" style="border-radius: 10px;">
                    <span class="input-group-text" style="background-color: #28a745; color: white; border-radius: 10px;">دولار</span>
                    <input type="hidden" name="type" value="custom">
                </div>

            @elseif ($category->type === 'multiple_choices')
                <!-- عرض عدة خيارات كـ Inputs -->
                <div class="form-group">
                    <div class="row">
                        <!-- الجزء الأول: تبرع لأسرة من 1-2 أفراد -->
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center border p-4 rounded-3 shadow-sm" style="background-color: #f1f1f1;">
                                <!-- الجزء الأيمن: المبلغ الثابت -->
                                <span class="fw-bold" style="font-size: 1.2rem; color: #28a745;">25.50$</span>

                                <!-- الجزء الأوسط: النص -->
                                <span class="flex-grow-1" style="font-size: 1.1rem;">تبرع بطرد غذائي لأسرة من 1-2 أفراد:</span>

                                <!-- الجزء الأيسر: اختيار عدد الأفراد -->
                                <div class="d-flex align-items-center border-start px-3">
                                    <button type="button" class="btn btn-outline-secondary" onclick="adjustPeople('people_1', -1)">-</button>
                                    <input type="number" id="people_1" class="form-control text-center" value="0" min="0" readonly style="width: 50px; height: 35px; font-size: 16px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="adjustPeople('people_1', 1)">+</button>

                                </div>
                            </div>
                            <input type="hidden" name="amount_1" value="25.50">
                            <input type="hidden" name="type_1" value="multiple_choices">
                        </div>

                        <!-- الجزء الثاني: تبرع لأسرة من 3-5 أفراد -->
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center border p-4 rounded-3 shadow-sm" style="background-color: #f1f1f1;">
                                <!-- الجزء الأيمن: المبلغ الثابت -->
                                <span class="fw-bold" style="font-size: 1.2rem; color: #28a745;">49.50$</span>

                                <!-- الجزء الأوسط: النص -->
                                <span class="flex-grow-1" style="font-size: 1.1rem;">تبرع بطرد غذائي لأسرة من 3-5 أفراد:</span>

                                <!-- الجزء الأيسر: اختيار عدد الأفراد -->
                                <div class="d-flex align-items-center border-start px-3">
                                    <button type="button" class="btn btn-outline-secondary" onclick="adjustPeople('people_2', -1)">-</button>
                                    <input type="number" id="people_2" class="form-control text-center" value="0" min="0" readonly style="width: 50px; height: 35px; font-size: 16px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="adjustPeople('people_2', 1)">+</button>

                                </div>
                            </div>
                            <input type="hidden" name="amount_2" value="49.50">
                            <input type="hidden" name="type_2" value="multiple_choices">
                        </div>

                        <!-- الجزء الثالث: تبرع لأسرة من 6 أفراد أو أكثر -->
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center border p-4 rounded-3 shadow-sm" style="background-color: #f1f1f1;">
                                <!-- الجزء الأيمن: المبلغ الثابت -->
                                <span class="fw-bold" style="font-size: 1.2rem; color: #28a745;">82.00$</span>

                                <!-- الجزء الأوسط: النص -->
                                <span class="flex-grow-1" style="font-size: 1.1rem;">تبرع بطرد غذائي لأسرة من 6 أفراد أو أكثر:</span>

                                <!-- الجزء الأيسر: اختيار عدد الأفراد -->
                                <div class="d-flex align-items-center border-start px-3">
                                    <button type="button" class="btn btn-outline-secondary" onclick="adjustPeople('people_3', -1)">-</button>
                                    <input type="number" id="people_3" class="form-control text-center" value="0" min="0" readonly style="width: 50px; height: 35px; font-size: 16px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="adjustPeople('people_3', 1)">+</button>

                                </div>
                            </div>
                            <input type="hidden" name="amount_3" value="82.00">
                            <input type="hidden" name="type_3" value="multiple_choices">
                        </div>
                    </div>
                </div>
            @endif

            <button type="submit" class="btn btn-success w-100 py-3 mt-4 fw-bold" style="font-size: 1.2rem; border-radius: 10px;">تبرع الآن</button>
        </form>
    </div>
</section>

<script>
    function adjustPeople(id, increment) {
        var input = document.getElementById(id);
        var currentValue = parseInt(input.value);
        if (increment < 0 && currentValue > 0) {
            input.value = currentValue - 1; // تقليل عدد الأفراد
        } else if (increment > 0) {
            input.value = currentValue + 1; // زيادة عدد الأفراد
        }
    }
</script>
@endsection
 --}}
