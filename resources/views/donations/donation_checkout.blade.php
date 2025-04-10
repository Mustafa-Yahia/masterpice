
@extends('layouts.app')

@section('content')
    <section class="donation-checkout-section" style="padding: 50px 0; background-color: #f9f9f9;">
        <div class="auto-container">
            <div class="sec-title centered" style="text-align: right;">
                <div class="sub-title" style="font-size: 18px; color: #3cc88f; font-weight: 600;">مراجعة بيانات التبرع</div>
                <h2 style="font-size: 36px; color: #25282a; font-weight: 700;">معلومات التبرع</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="checkout-details" style="background-color: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); text-align: right;">
                        <h3 style="color: #25282a;">البيانات المدخلة:</h3>

                        <p><strong>عدد الأفراد:</strong> {{ $data['people_count'] }}</p>
                        <p><strong>المبلغ المدخل:</strong> {{ $data['amount'] }} دينار أردني</p>
                        <p><strong>العملة:</strong> {{ $data['currency'] }}</p>
                        <p><strong>حالة الدفع:</strong> {{ $data['payment_status'] }}</p>

                        <form method="POST" action="{{ route('donation.process', $category->id) }}">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $data['amount'] }}">
                            <input type="hidden" name="currency" value="{{ $data['currency'] }}">
                            <input type="hidden" name="payment_status" value="{{ $data['payment_status'] }}">
                            <input type="hidden" name="people_count" value="{{ $data['people_count'] }}">
                            <input type="hidden" name="category_id" value="{{ $category->id }}">

                            <button type="submit" class="theme-btn btn-style-one" style="background-color: #3cc88f; color: #fff; border-radius: 8px; padding: 12px 30px; font-size: 16px;">
                                <span class="btn-title">تأكيد التبرع</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




{{-- @extends('layouts.app')

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
                                <div class="input-group" style="width: 150px; direction: rtl; top:20px">
                                    <button type="button" class="btn btn-secondary" id="decrement" style="font-size: 20px; width: 35px;">-</button>
                                    <input type="number" id="people-count" class="form-control" value="1" min="1" style="font-size: 16px; text-align: center; width: 60px;">
                                    <button type="button" class="btn btn-secondary" id="increment" style="font-size: 20px; width: 35px;">+</button>
                                </div>

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

@endsection --}}
