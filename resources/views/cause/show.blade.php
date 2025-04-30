@extends('layouts.app')

@section('content')

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'تم التبرع بنجاح',
            text: '{{ session('success') }}',
            confirmButtonText: 'موافق'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'فشل التبرع',
            text: '{{ session('error') }}',
            confirmButtonText: 'موافق'
        });
    </script>
@endif

<!-- صفحة تفاصيل الحملة -->
<section class="page-banner">
    <div class="image-layer lazy-image" data-bg="url('{{ asset('images/background/Backgroundlogin.png') }}')"></div>
    <div class="bottom-rotten-curve"></div>

    <div class="auto-container" dir="rtl">
        <!-- العنوان في المنتصف -->
        <h1 class="display-5 fw-bold text-white wow fadeInUp text-center">{{ $cause->title }}</h1>

        <!-- المسار مع ترتيب RTL -->
        <ul class="bread-crumb clearfix mt-2 d-flex justify-content-center" style="direction: rtl; gap: 10px; list-style: none;">
            <li class="active">{{ $cause->title }}</li>
            <li><span style="color: #ccc;">›</span></li>
            <li><a href="{{ route('home') }}">الرئيسية</a></li>
        </ul>
    </div>
</section>

<section class="donate-section py-5 bg-light" dir="rtl">
    <div class="auto-container">
        <div class="row gy-5 align-items-start">
           <!-- تفاصيل الحملة -->
<div class="col-lg-7">
    <div class="p-4 rounded bg-white shadow-sm wow fadeInUp text-end">
        <h2   class="mb-4 text-primary"><i class="fas fa-campaign"></i> {{ $cause->title }}</h2>

        <img class="img-fluid rounded mb-4" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">

        <div class="mb-3">
            <h5 class="fw-bold"><i class="fas fa-info-circle"></i> الوصف:</h5>
            <p class="text-muted">{{ $cause->description }}</p>
        </div>

        @if(!empty($cause->additional_details))
            <div class="mb-4">
                <h5 class="fw-bold"><i class="fas fa-ellipsis-h"></i> تفاصيل إضافية:</h5>
                <div class="p-3 rounded bg-light border text-muted" style="font-size: 15px; line-height: 1.7; text-align: right;">
                    {{ $cause->additional_details }}
                </div>
            </div>
        @endif

        <div class="row mb-4">
            <!-- قسم -->
            <div class="col-md-4">
                <h6 class="fw-bold"><i class="fas fa-tag"></i> القسم:</h6>
                <p class="text-muted">{{ $cause->category }}</p>
            </div>

            <!-- الموقع -->
            <div class="col-md-4">
                <h6 class="fw-bold"><i class="fas fa-location-pin"></i> الموقع:</h6>
                <p class="text-muted">{{ $cause->location ?? 'غير محدد' }}</p>
            </div>

            <!-- تاريخ انتهاء الحملة -->
            <div class="col-md-4">
                <h6 class="fw-bold"><i class="fas fa-calendar-alt"></i> تاريخ انتهاء الحملة:</h6>
                <p class="text-muted">{{ \Carbon\Carbon::parse($cause->end_time)->format('Y-m-d') }}</p>
            </div>
        </div>


        <div class="mb-3" style="text-align:right">
            <h6 class="fw-bold"><i class="fas fa-donate"></i> التبرعات:</h6>
            <p><strong>تم جمع:</strong> {{ $raisedAmountArabic }} د.أ</p>
            <p><strong>الهدف:</strong> {{ $goalAmountArabic }} د.أ</p>
        </div>

        @php
            $percent = $cause->goal_amount > 0 ? ($cause->raised_amount / $cause->goal_amount) * 100 : 0;
        @endphp
        <div class="progress mb-4" style="height: 22px; border-radius: 12px; overflow: hidden;">
            <div class="progress-bar text-end px-3 d-flex align-items-center justify-content-end text-white fw-bold"
            style="width: {{ $percent }}%; background-color: #3cc88f; transition: width 1.5s ease-in-out;"
            aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
            {{ number_format($percent, 0) }}%
        </div>

        </div>


    </div>
</div>
    <!-- معلومات المسؤول + نموذج التبرع -->
<div class="col-lg-5">
    <div class="p-4 rounded bg-white border shadow-sm wow fadeInUp text-end" data-wow-delay="0.3s">
        <h4 class="mb-3" style="text-align:center"><i class="fas fa-user"></i> المسؤول عن الحملة</h4>
        <ul class="list-unstyled text-muted mb-4">
            <li class="mb-2" style="text-align:right"><strong><i class="fas fa-user-circle"></i> الاسم:</strong> {{ $cause->responsible_person_name ?? 'غير محدد' }}</li>
            <li style="text-align:right"><strong><i class="fas fa-envelope"></i> البريد الإلكتروني:</strong> {{ $cause->responsible_person_email ?? 'غير متوفر' }}</li>
        </ul>

        <hr>
        <h5 class="mb-3"><i class="fas fa-share-alt"></i> شارك الحملة:</h5>
        <div class="d-flex gap-2">
            <a href="https://wa.me/?text={{ urlencode(route('cause.show', $cause->id)) }}" target="_blank" class="btn btn-outline-success w-100"><i class="fab fa-whatsapp"></i> واتساب</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('cause.show', $cause->id)) }}" target="_blank" class="btn btn-outline-primary w-100"><i class="fab fa-facebook-square"></i> فيسبوك</a>
        </div>
    </div><!-- التبرع -->
    <div class="inner p-4 mt-4 bg-white rounded shadow-sm wow fadeInUp text-end" data-wow-delay="0.4s">
        <h4 class="mb-4" style="text-align:center"><i class="fas fa-hand-holding-heart"></i> تبرع الآن</h4>
        <form method="POST" action="{{ route('donation.store') }}" style="direction: rtl;" id="donation-form">
            @csrf
            <input type="hidden" name="cause_id" value="{{ $cause->id }}">

            <div class="form-group mb-3" style="text-align:right">
                <label for="amount"><i class="fas fa-money-bill-wave"></i> المبلغ (د.أ)</label>
                <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required>
                <div id="amount-error" class="error-message"></div> <!-- رسالة الخطأ أسفل الحقل -->
            </div>

            <div class="form-group mb-3" style="text-align:right">
                <label for="payment_method_id"><i class="fas fa-credit-card"></i> طريقة الدفع</label>
                <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                    @foreach(\App\Models\PaymentMethod::all() as $method)
                        <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                    @endforeach
                </select>
                <div id="payment-method-error" class="error-message"></div> <!-- رسالة الخطأ أسفل الحقل -->
            </div>

            <div class="form-group mb-3" style="text-align:right">
                <label><i class="fas fa-credit-card"></i> معلومات البطاقة</label>
                <input type="text" name="card_holder_name" class="form-control mb-2" placeholder="اسم صاحب البطاقة" required>
                <div id="card-holder-error" class="error-message"></div> <!-- رسالة الخطأ أسفل الحقل -->

                <input type="text" name="card_number" class="form-control mb-2" placeholder="رقم البطاقة" required>
                <div id="card-number-error" class="error-message"></div> <!-- رسالة الخطأ أسفل الحقل -->

                <div class="d-flex gap-2">
                    <div class="flex-column">
                        <!-- استبدال input بـ Flatpickr -->
                        <input type="text" name="card_expiry" id="card_expiry" class="form-control" placeholder="MM/YY" required>
                        <div id="card-expiry-error" class="error-message"></div> <!-- رسالة الخطأ أسفل الحقل -->
                    </div>

                    <div class="flex-column">
                        <input type="text" name="card_cvc" class="form-control" placeholder="CVC" required>
                        <div id="card-cvc-error" class="error-message"></div> <!-- رسالة الخطأ أسفل الحقل -->
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="theme-btn btn-style-one w-100"><span class="btn-title">إتمام التبرع</span></button>
            </div>
        </form>
    </div>

    <!-- عرض المبلغ الزائد المتاح -->
    @if ($cause->extra_raised_amount > 0)
        <div class="alert alert-info" role="alert">
            <strong>المبلغ الزائد المتاح: </strong>{{ $cause->extra_raised_amount }} د.أ
            <p>سيتم تخصيص هذا المبلغ لأغراض أخرى، مثل الحالات العاجلة أو المشاريع المستمرة.</p>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> <!-- إضافة Flatpickr -->

    <script>
        $(document).ready(function() {
            // تفعيل Flatpickr لاختيار تاريخ انتهاء البطاقة بتنسيق MM/YY
            flatpickr("#card_expiry", {
                dateFormat: "m/y",  // تنسيق التاريخ كما MM/YY
                minDate: "today",   // تحديد الحد الأدنى للتاريخ ليكون اليوم
            });

            // تحديث التقدم في الصفحة
            var raisedAmount = {{ $cause->raised_amount }};  // المبلغ الذي تم جمعه
            var goalAmount = {{ $cause->goal_amount }};  // الهدف

            // إذا كان المبلغ الذي تم جمعه أكبر من الهدف، نأخذ فقط المبلغ الذي يساوي الهدف
            if (raisedAmount > goalAmount) {
                raisedAmount = goalAmount;  // تأكد أن المبلغ المجموع لا يتجاوز الهدف
            }

            // حساب النسبة المئوية للتقدم بناءً على المبلغ المجموع والهدف
            var progress = (raisedAmount / goalAmount) * 100;

            // التأكد من أن النسبة المئوية لا تتجاوز 100%
            if (progress > 100) {
                progress = 100;  // الحد الأقصى للنسبة هو 100%
            }

            // تحديث الـ progress bar
            $('.progress-bar').css('width', progress + '%');
            $('.progress-bar').text(Math.round(progress) + '%');  // تحديث النص داخل الـ progress bar

            // تعطيل زر التبرع إذا تم الوصول إلى الهدف
            if (raisedAmount >= goalAmount) {
                $('button[type="submit"]').prop('disabled', true);
                $('button[type="submit"]').text('تم الوصول إلى الهدف');
            }

            // التعامل مع التبرع
            $('#donation-form').on('submit', function(e) {
                e.preventDefault();  // منع إرسال النموذج بالطريقة التقليدية

                // تنظيف الأخطاء السابقة
                $('.error-message').text('').fadeOut();

                // التحقق من صحة المدخلات باستخدام JavaScript
                var isValid = true;

                var cardHolderName = $('input[name="card_holder_name"]').val();
                var cardNumber = $('input[name="card_number"]').val();
                var cardExpiry = $('input[name="card_expiry"]').val();
                var cardCvc = $('input[name="card_cvc"]').val();
                var amount = $('input[name="amount"]').val();

                // التحقق من المبلغ
                if (amount <= 0 || isNaN(amount)) {
                    $('#amount-error').text('المبلغ يجب أن يكون رقمًا أكبر من 0.').fadeIn();
                    isValid = false;
                }

                // التحقق من رقم البطاقة
                var cardNumberRegex = /^[0-9]{16}$/;
                if (!cardNumberRegex.test(cardNumber)) {
                    $('#card-number-error').text('رقم البطاقة يجب أن يتكون من 16 رقم.').fadeIn();
                    isValid = false;
                }

                // التحقق من تاريخ انتهاء البطاقة
                var expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
                if (!expiryRegex.test(cardExpiry)) {
                    $('#card-expiry-error').text('تاريخ انتهاء البطاقة غير صحيح. يرجى إدخال التاريخ بتنسيق MM/YY.').fadeIn();
                    isValid = false;
                } else {
                    // تحويل تاريخ الانتهاء المدخل إلى تنسيق تاريخ JavaScript
                    var currentDate = new Date(); // تاريخ اليوم
                    var cardExpiryParts = cardExpiry.split('/');
                    var expiryDate = new Date('20' + cardExpiryParts[1], cardExpiryParts[0] - 1); // تحويل MM/YY إلى تنسيق صحيح

                    // التحقق مما إذا كان تاريخ البطاقة في المستقبل
                    if (expiryDate < currentDate) {
                        $('#card-expiry-error').text('تاريخ انتهاء البطاقة قد مضى. يرجى إدخال تاريخ صحيح.').fadeIn();
                        isValid = false;
                    }
                }

                // التحقق من رمز CVC
                var cvcRegex = /^[0-9]{3,4}$/;
                if (!cvcRegex.test(cardCvc)) {
                    $('#card-cvc-error').text('رمز CVC يجب أن يتكون من 3 أو 4 أرقام.').fadeIn();
                    isValid = false;
                }

                // إذا كانت المدخلات صحيحة، نقوم بإرسال النموذج عبر AJAX
                if (isValid) {
                    var formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            if(response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'تم التبرع بنجاح',
                                    text: response.message,
                                    confirmButtonText: 'موافق'
                                }).then(function() {
                                    location.reload(); // إعادة تحميل الصفحة بعد النجاح
                                });

                                // إظهار رسالة للمستخدم في حالة تجاوز الهدف
                                if (amount > {{ $cause->goal_amount }}) {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'تم تجاوز الهدف!',
                                        text: 'تم تبرعك بمبلغ يتجاوز الهدف. سيتم تخصيص المبلغ الزائد لأغراض أخرى.',
                                        confirmButtonText: 'موافق'
                                    });
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'فشل التبرع',
                                    text: response.message,
                                    confirmButtonText: 'موافق'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'حدث خطأ غير متوقع',
                                text: ' يرجى تسجيل الدخول لاتمام التبرع',
                                confirmButtonText: 'موافق'
                            });
                        }
                    });
                }
            });
        });
    </script>



<style>

    /* تصميم الزر عندما يتم الوصول إلى الهدف */
button[type="submit"].disabled-button {
    background-color: #28a745; /* اللون الأخضر (يظهر عند الوصول للهدف) */
    border: none;
    color: #fff;
    cursor: not-allowed; /* يشير إلى أن الزر غير قابل للنقر */
    padding: 15px 30px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 50px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
}

button[type="submit"].disabled-button:hover {
    background-color: #218838; /* لون أخضر داكن عند المرور بالماوس */
}

button[type="submit"].disabled-button:active {
    background-color: #1e7e34; /* لون أخضر أغمق عند الضغط */
}

button[type="submit"]:disabled {
    background-color: #ddd; /* لون رمادي عند تعطيل الزر */
    color: #888; /* لون النص رمادي عند تعطيل الزر */
    cursor: not-allowed; /* يشير إلى أن الزر غير قابل للنقر */
}
    /* تصميم رسائل الخطأ أسفل الحقول */
    .error-message {
        color: #ff3333;
        font-size: 0.9em;
        margin-top: 5px;
        display: none;
        background-color: #f8d7da;
        padding: 5px;
        border-radius: 3px;
        border: 1px solid #f5c6cb;
        text-align: right;
        font-weight: bold;
    }

    /* إضافة المسافة بين الحقول ورسائل الخطأ */
    .form-group {
        position: relative;
    }

    /* ترتيب الحقول بشكل عمودي في نفس السطر */
    .d-flex {
        flex-wrap: wrap;
        gap: 10px;
    }

    .flex-column {
        flex: 1;
        min-width: 180px; /* ضمان أن الحقول لا تصبح ضيقة جدًا */
    }

    /* التأثيرات على الرسائل */
    .error-message {
        transition: opacity 0.3s ease;
    }
</style>
@endsection



{{-- @extends('layouts.app')

@section('content')

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'تم التبرع بنجاح',
            text: '{{ session('success') }}',
            confirmButtonText: 'موافق'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'فشل التبرع',
            text: '{{ session('error') }}',
            confirmButtonText: 'موافق'
        });
    </script>
@endif


<!-- صفحة تفاصيل الحملة -->
<section class="page-banner">
    <div class="image-layer lazy-image" data-bg="url('{{ asset('images/background/bg-banner-1.jpg') }}')"></div>
    <div class="bottom-rotten-curve"></div>

    <div class="auto-container" dir="rtl">
        <!-- العنوان في المنتصف -->
        <h1 class="display-5 fw-bold text-white wow fadeInUp text-center">{{ $cause->title }}</h1>

        <!-- المسار مع ترتيب RTL -->
        <ul class="bread-crumb clearfix mt-2 d-flex justify-content-center" style="direction: rtl; gap: 10px; list-style: none;">
            <li class="active">{{ $cause->title }}</li>
            <li><span style="color: #ccc;">›</span></li>
            <li><a href="{{ route('home') }}">الرئيسية</a></li>
        </ul>
    </div>
</section>

<section class="donate-section py-5 bg-light" dir="rtl">
    <div class="auto-container">
        <div class="row gy-5 align-items-start">
            <!-- تفاصيل الحملة -->
            <div class="col-lg-7">
                <div class="p-4 rounded bg-white shadow-sm wow fadeInUp text-end">
                    <h2 class="mb-4 text-primary"><i class="fas fa-campaign"></i> {{ $cause->title }}</h2>

                    <img class="img-fluid rounded mb-4" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">

                    <div class="mb-3">
                        <h5 class="fw-bold"><i class="fas fa-info-circle"></i> الوصف:</h5>
                        <p class="text-muted">{{ $cause->description }}</p>
                    </div>

                    @if(!empty($cause->additional_details))
                        <div class="mb-4">
                            <h5 class="fw-bold"><i class="fas fa-ellipsis-h"></i> تفاصيل إضافية:</h5>
                            <div class="p-3 rounded bg-light border text-muted" style="font-size: 15px; line-height: 1.7;">
                                {{ $cause->additional_details }}
                            </div>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold"><i class="fas fa-tag"></i> القسم:</h6>
                            <p class="text-muted">{{ $cause->category }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold"><i class="fas fa-calendar-alt"></i> تاريخ انتهاء الحملة:</h6>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($cause->end_time)->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <div class="mb-3" style="text-align:right">
                        <h6 class="fw-bold"><i class="fas fa-donate"></i> التبرعات:</h6>
                        <p><strong>تم جمع:</strong> {{ number_format($cause->raised_amount) }} د.أ</p>
                        <p><strong>الهدف:</strong> {{ number_format($cause->goal_amount) }} د.أ</p>
                    </div>

                    @php
                        $percent = $cause->goal_amount > 0 ? ($cause->raised_amount / $cause->goal_amount) * 100 : 0;
                    @endphp
                    <div class="progress mb-4" style="height: 22px; border-radius: 12px; overflow: hidden;">
                        <div class="progress-bar bg-success text-end px-3 d-flex align-items-center justify-content-end text-white fw-bold"
                             style="width: {{ $percent }}%; transition: width 1.5s ease-in-out;"
                             aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($percent, 0) }}%
                        </div>
                    </div>
                </div>
            </div>

            <!-- معلومات المسؤول + نموذج التبرع -->
            <div class="col-lg-5">
                <!-- المسؤول -->
                <div class="p-4 rounded bg-white border shadow-sm wow fadeInUp text-end" data-wow-delay="0.3s">
                    <h4 class="mb-3" style="text-align:center"><i class="fas fa-user"></i> المسؤول عن الحملة</h4>
                    <ul class="list-unstyled text-muted mb-4">
                        <li class="mb-2" style="text-align:right"><strong><i class="fas fa-user-circle"></i> الاسم:</strong> {{ $cause->user->name ?? 'غير محدد' }}</li>
                        <li style="text-align:right"><strong><i class="fas fa-envelope"></i> البريد الإلكتروني:</strong> {{ $cause->user->email ?? 'غير متوفر' }}</li>
                    </ul>

                    <hr>
                    <h5 class="mb-3"><i class="fas fa-share-alt"></i> شارك الحملة:</h5>
                    <div class="d-flex gap-2">
                        <a href="https://wa.me/?text={{ urlencode(route('cause.show', $cause->id)) }}" target="_blank" class="btn btn-outline-success w-100"><i class="fab fa-whatsapp"></i> واتساب</a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('cause.show', $cause->id)) }}" target="_blank" class="btn btn-outline-primary w-100"><i class="fab fa-facebook-square"></i> فيسبوك</a>
                    </div>
                </div>

                <!-- التبرع -->
                <div class="inner p-4 mt-4 bg-white rounded shadow-sm wow fadeInUp text-end" data-wow-delay="0.4s">
                    <h4 class="mb-4" style="text-align:center"><i class="fas fa-hand-holding-heart"></i> تبرع الآن</h4>

                    <form method="POST" action="{{ route('donation.store') }}" style="direction: rtl;">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">

                        <div class="form-group mb-3" style="text-align:right">
                            <label for="amount"><i class="fas fa-money-bill-wave"></i> المبلغ (د.أ)</label>
                            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required>
                        </div>

                        <div class="form-group mb-3" style="text-align:right">
                            <label for="payment_method_id"><i class="fas fa-credit-card"></i> طريقة الدفع</label>
                            <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                @foreach(\App\Models\PaymentMethod::all() as $method)
                                    <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3" style="text-align:right">
                            <label><i class="fas fa-credit-card"></i> معلومات البطاقة</label>
                            <input type="text" name="card_holder_name" class="form-control mb-2" placeholder="اسم صاحب البطاقة" required>
                            <input type="text" name="card_number" class="form-control mb-2" placeholder="رقم البطاقة" required>
                            <div class="d-flex gap-2">
                                <input type="text" name="card_expiry" class="form-control" placeholder="MM/YY" required>
                                <input type="text" name="card_cvc" class="form-control" placeholder="CVC" required>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="theme-btn btn-style-one w-100"><span class="btn-title">إتمام التبرع</span></button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection --}}
{{--
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'تم التبرع بنجاح',
            text: '{{ session('success') }}',
            confirmButtonText: 'موافق'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'فشل التبرع',
            text: '{{ session('error') }}',
            confirmButtonText: 'موافق'
        });
    </script>
@endif --}}


{{-- @extends('layouts.app')

@section('content')

<!-- صفحة تفاصيل الحملة -->
<section class="page-banner">
    <div class="image-layer lazy-image" data-bg="url('{{ asset('images/background/bg-banner-1.jpg') }}')"></div>
    <div class="bottom-rotten-curve"></div>

    <div class="auto-container" dir="rtl">
        <!-- العنوان في المنتصف -->
        <h1 class="display-5 fw-bold text-white wow fadeInUp text-center">{{ $cause->title }}</h1>

        <!-- المسار مع ترتيب RTL -->
        <ul class="bread-crumb clearfix mt-2 d-flex justify-content-center" style="direction: rtl; gap: 10px; list-style: none;">
            <li class="active">{{ $cause->title }}</li>
            <li><span style="color: #ccc;">›</span></li>
            <li><a href="{{ route('home') }}">الرئيسية</a></li>
        </ul>
    </div>
</section>

<section class="donate-section py-5 bg-light" dir="rtl">
    <div class="auto-container">
        <div class="row gy-5 align-items-start">
            <!-- تفاصيل الحملة -->
            <div class="col-lg-7">
                <div class="p-4 rounded bg-white shadow-sm wow fadeInUp text-end">
                    <h2 class="mb-4 text-primary"><i class="fas fa-campaign"></i> {{ $cause->title }}</h2>

                    <img class="img-fluid rounded mb-4" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">

                    <div class="mb-3">
                        <h5 class="fw-bold"><i class="fas fa-info-circle"></i> الوصف:</h5>
                        <p class="text-muted">{{ $cause->description }}</p>
                    </div>

                    @if(!empty($cause->additional_details))
                        <div class="mb-4">
                            <h5 class="fw-bold"><i class="fas fa-ellipsis-h"></i> تفاصيل إضافية:</h5>
                            <div class="p-3 rounded bg-light border text-muted" style="font-size: 15px; line-height: 1.7;">
                                {{ $cause->additional_details }}
                            </div>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold"><i class="fas fa-tag"></i> القسم:</h6>
                            <p class="text-muted">{{ $cause->category }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold"><i class="fas fa-calendar-alt"></i> تاريخ انتهاء الحملة:</h6>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($cause->end_time)->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <div class="mb-3" style="text-align:right">
                        <h6 class="fw-bold"><i class="fas fa-donate"></i> التبرعات:</h6>
                        <p><strong>تم جمع:</strong> {{ number_format($cause->raised_amount) }} د.أ</p>
                        <p><strong>الهدف:</strong> {{ number_format($cause->goal_amount) }} د.أ</p>
                    </div>

                    @php
                        $percent = $cause->goal_amount > 0 ? ($cause->raised_amount / $cause->goal_amount) * 100 : 0;
                    @endphp
                    <div class="progress mb-4" style="height: 22px; border-radius: 12px; overflow: hidden;">
                        <div class="progress-bar bg-success text-end px-3 d-flex align-items-center justify-content-end text-white fw-bold"
                             style="width: {{ $percent }}%; transition: width 1.5s ease-in-out;"
                             aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($percent, 0) }}%
                        </div>
                    </div>
                </div>
            </div>

            <!-- معلومات المسؤول + نموذج التبرع -->
            <div class="col-lg-5">
                <!-- المسؤول -->
                <div class="p-4 rounded bg-white border shadow-sm wow fadeInUp text-end" data-wow-delay="0.3s">
                    <h4 class="mb-3" style="text-align:center"><i class="fas fa-user"></i> المسؤول عن الحملة</h4>
                    <ul class="list-unstyled text-muted mb-4">
                        <li class="mb-2" style="text-align:right"><strong><i class="fas fa-user-circle"></i> الاسم:</strong> {{ $cause->user->name ?? 'غير محدد' }}</li>
                        <li style="text-align:right"><strong><i class="fas fa-envelope"></i> البريد الإلكتروني:</strong> {{ $cause->user->email ?? 'غير متوفر' }}</li>
                    </ul>

                    <hr>
                    <h5 class="mb-3"><i class="fas fa-share-alt"></i> شارك الحملة:</h5>
                    <div class="d-flex gap-2">
                        <a href="https://wa.me/?text={{ urlencode(route('cause.show', $cause->id)) }}" target="_blank" class="btn btn-outline-success w-100"><i class="fab fa-whatsapp"></i> واتساب</a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('cause.show', $cause->id)) }}" target="_blank" class="btn btn-outline-primary w-100"><i class="fab fa-facebook-square"></i> فيسبوك</a>
                    </div>
                </div>

                <!-- التبرع -->
                <div class="inner p-4 mt-4 bg-white rounded shadow-sm wow fadeInUp text-end" data-wow-delay="0.4s">
                    <h4 class="mb-4" style="text-align:center"><i class="fas fa-hand-holding-heart"></i> تبرع الآن</h4>

                    <form method="POST" action="{{ route('donation.store') }}" style="direction: rtl;">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">

                        <div class="form-group mb-3" style="text-align:right">
                            <label for="amount"><i class="fas fa-money-bill-wave"></i> المبلغ (د.أ)</label>
                            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required>
                        </div>

                        <div class="form-group mb-3" style="text-align:right">
                            <label for="payment_method_id"><i class="fas fa-credit-card"></i> طريقة الدفع</label>
                            <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                @foreach(\App\Models\PaymentMethod::all() as $method)
                                    <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3" style="text-align:right">
                            <label><i class="fas fa-credit-card"></i> معلومات البطاقة</label>
                            <input type="text" name="card_holder_name" class="form-control mb-2" placeholder="اسم صاحب البطاقة" required>
                            <input type="text" name="card_number" class="form-control mb-2" placeholder="رقم البطاقة" required>
                            <div class="d-flex gap-2">
                                <input type="text" name="card_expiry" class="form-control" placeholder="MM/YY" required>
                                <input type="text" name="card_cvc" class="form-control" placeholder="CVC" required>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="theme-btn btn-style-one w-100 "><span class="btn-title">إتمام التبرع</span></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection --}}









{{-- ================================= --}}
{{--
<script>
    $(document).ready(function() {
        $('#donation-form').on('submit', function(e) {
            e.preventDefault();  // منع إرسال النموذج بالطريقة التقليدية

            // تنظيف الأخطاء السابقة
            $('.error-message').text('').fadeOut();

            // التحقق من صحة المدخلات باستخدام JavaScript
            var isValid = true;

            var cardHolderName = $('input[name="card_holder_name"]').val();
            var cardNumber = $('input[name="card_number"]').val();
            var cardExpiry = $('input[name="card_expiry"]').val();
            var cardCvc = $('input[name="card_cvc"]').val();
            var amount = $('input[name="amount"]').val();

            // التحقق من المبلغ
            if (amount <= 0 || isNaN(amount)) {
                $('#amount-error').text('المبلغ يجب أن يكون رقمًا أكبر من 0.').fadeIn();
                isValid = false;
            }

            // التحقق من رقم البطاقة
            var cardNumberRegex = /^[0-9]{16}$/;
            if (!cardNumberRegex.test(cardNumber)) {
                $('#card-number-error').text('رقم البطاقة يجب أن يتكون من 16 رقم.').fadeIn();
                isValid = false;
            }

            // التحقق من تاريخ انتهاء البطاقة
            var expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
            if (!expiryRegex.test(cardExpiry)) {
                $('#card-expiry-error').text('تاريخ انتهاء البطاقة غير صحيح. يرجى إدخال التاريخ بتنسيق MM/YY.').fadeIn();
                isValid = false;
            }

            // التحقق من رمز CVC
            var cvcRegex = /^[0-9]{3,4}$/;
            if (!cvcRegex.test(cardCvc)) {
                $('#card-cvc-error').text('رمز CVC يجب أن يتكون من 3 أو 4 أرقام.').fadeIn();
                isValid = false;
            }

            // إذا كانت المدخلات صحيحة، نقوم بإرسال النموذج عبر AJAX
            if (isValid) {
                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'تم التبرع بنجاح',
                                text: response.message,
                                confirmButtonText: 'موافق'
                            }).then(function() {
                                location.reload(); // إعادة تحميل الصفحة بعد النجاح
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'فشل التبرع',
                                text: response.message,
                                confirmButtonText: 'موافق'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'حدث خطأ غير متوقع',
                            text: 'يرجى المحاولة مرة أخرى.',
                            confirmButtonText: 'موافق'
                        });
                    }
                });
            }
        });
    });
</script> --}}

{{-- <script>
$(document).ready(function() {
    // تحديث التقدم في الصفحة
    var progress = {{ $percent }};
    var raisedAmount = {{ $cause->raised_amount }};
    var goalAmount = {{ $cause->goal_amount }};

    // التحقق من التقدم والمبلغ المطلوب
    if (progress >= 100 || raisedAmount >= goalAmount) {
        // تعطيل زر التبرع إذا وصل التقدم إلى 100% أو تم جمع المبلغ المطلوب
        $('button[type="submit"]').prop('disabled', true);
        $('button[type="submit"]').text('تم الوصول إلى الهدف');
    }

    $('#donation-form').on('submit', function(e) {
        e.preventDefault();  // منع إرسال النموذج بالطريقة التقليدية

        // تنظيف الأخطاء السابقة
        $('.error-message').text('').fadeOut();

        // التحقق من صحة المدخلات باستخدام JavaScript
        var isValid = true;

        var cardHolderName = $('input[name="card_holder_name"]').val();
        var cardNumber = $('input[name="card_number"]').val();
        var cardExpiry = $('input[name="card_expiry"]').val();
        var cardCvc = $('input[name="card_cvc"]').val();
        var amount = $('input[name="amount"]').val();

        // التحقق من المبلغ
        if (amount <= 0 || isNaN(amount)) {
            $('#amount-error').text('المبلغ يجب أن يكون رقمًا أكبر من 0.').fadeIn();
            isValid = false;
        }

        // التحقق من رقم البطاقة
        var cardNumberRegex = /^[0-9]{16}$/;
        if (!cardNumberRegex.test(cardNumber)) {
            $('#card-number-error').text('رقم البطاقة يجب أن يتكون من 16 رقم.').fadeIn();
            isValid = false;
        }

        // التحقق من تاريخ انتهاء البطاقة
        var expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
        if (!expiryRegex.test(cardExpiry)) {
            $('#card-expiry-error').text('تاريخ انتهاء البطاقة غير صحيح. يرجى إدخال التاريخ بتنسيق MM/YY.').fadeIn();
            isValid = false;
        }

        // التحقق من رمز CVC
        var cvcRegex = /^[0-9]{3,4}$/;
        if (!cvcRegex.test(cardCvc)) {
            $('#card-cvc-error').text('رمز CVC يجب أن يتكون من 3 أو 4 أرقام.').fadeIn();
            isValid = false;
        }

        // إذا كانت المدخلات صحيحة، نقوم بإرسال النموذج عبر AJAX
        if (isValid) {
            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'تم التبرع بنجاح',
                            text: response.message,
                            confirmButtonText: 'موافق'
                        }).then(function() {
                            location.reload(); // إعادة تحميل الصفحة بعد النجاح
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'فشل التبرع',
                            text: response.message,
                            confirmButtonText: 'موافق'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'حدث خطأ غير متوقع',
                        text: 'يرجى المحاولة مرة أخرى.',
                        confirmButtonText: 'موافق'
                    });
                }
            });
        }
    });
});
</script> --}}
