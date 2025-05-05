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
                <div class="p-5 rounded-4 bg-white shadow-lg wow fadeInUp text-end" style="border: 1px solid rgba(0,0,0,0.1);">
                    <!-- العنوان مع أيقونة معدلة -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box bg-primary-light p-3 rounded-3 me-3">
                            <i class="fas fa-hands-helping text-primary fs-4"></i>
                        </div>
                        <h2 class="mb-0 text-dark">{{ $cause->title }}</h2>
                    </div>

                    <!-- صورة الحملة مع تأثير هفر -->
                    <div class="overflow-hidden rounded-4 mb-4" style="height: 280px;">
                        <img class="img-fluid w-100 h-100 object-fit-cover transition-scale"
                             src="{{ asset('storage/' . $cause->image) }}"
                             alt="{{ $cause->title }}"
                             style="transition: transform 0.5s ease;">
                    </div>

                    <!-- الوصف مع تحسينات التنسيق -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle text-secondary me-2 fs-5"></i>
                            <h5 class="fw-bold mb-0 text-dark">وصف الحملة:</h5>
                        </div>
                        <p class="text-muted lh-lg" style="font-size: 16px; text-align: justify;">
                            {{ $cause->description }}
                        </p>
                    </div>

                    <!-- التفاصيل الإضافية مع تصميم محسن -->
                    @if(!empty($cause->additional_details))
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-ellipsis-h text-secondary me-2 fs-5"></i>
                                <h5 class="fw-bold mb-0 text-dark">تفاصيل إضافية:</h5>
                            </div>
                            <div class="p-4 rounded-4 bg-light border"
                                 style="font-size: 15px; line-height: 1.8; text-align: right; border-color: rgba(0,0,0,0.05) !important;">
                                {!! nl2br(e($cause->additional_details)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- معلومات الحملة في كروت منفصلة -->
                    <div class="row g-3 mb-4">
                        <!-- القسم -->
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light-hover h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-tag text-secondary me-2 fs-6"></i>
                                    <h6 class="fw-bold mb-0 text-dark">القسم:</h6>
                                </div>
                                <p class="text-muted mb-0">{{ $cause->category }}</p>
                            </div>
                        </div>

                        <!-- الموقع -->
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light-hover h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-location-dot text-secondary me-2 fs-6"></i>
                                    <h6 class="fw-bold mb-0 text-dark">الموقع:</h6>
                                </div>
                                <p class="text-muted mb-0">{{ $cause->location ?? 'غير محدد' }}</p>
                            </div>
                        </div>

                        <!-- تاريخ الانتهاء -->
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light-hover h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-days text-secondary me-2 fs-6"></i>
                                    <h6 class="fw-bold mb-0 text-dark">تاريخ الانتهاء:</h6>
                                </div>
                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($cause->end_date)->format('Y-m-d') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- إحصاءات التبرع مع شريط التقدم المحسن -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-hand-holding-heart text-secondary me-2 fs-5"></i>
                            <h5 class="fw-bold mb-0 text-dark">حالة التبرعات:</h5>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">تم جمع: {{ $raisedAmountArabic }} د.أ</span>
                            <span class="text-muted">الهدف: {{ $goalAmountArabic }} د.أ</span>
                        </div>

                        @php
                            $percent = $cause->goal_amount > 0 ? ($cause->raised_amount / $cause->goal_amount) * 100 : 0;
                            $remaining = $cause->goal_amount - $cause->raised_amount;
                        @endphp

                        <div class="progress mb-3" style="height: 12px; border-radius: 6px;">
                            <div class="progress-bar bg-primary-gradient"
                                 role="progressbar"
                                 style="width: {{ $percent }}%; transition: width 1.5s ease;"
                                 aria-valuenow="{{ $percent }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary-light text-primary rounded-pill px-3 py-2">
                                {{ number_format($percent, 1) }}%
                            </span>
                            <small class="text-muted">
                                @if($remaining > 0)
                                    متبقي {{ number_format($remaining) }} د.أ لتحقيق الهدف
                                @else
                                    تم تحقيق الهدف بنجاح
                                @endif
                            </small>
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
                </div>

                <!-- التبرع -->
                <div class="inner p-4 mt-4 bg-white rounded-3 shadow-lg wow fadeInUp text-end" data-wow-delay="0.4s" style="max-width: 600px; margin: 0 auto;">
                    <h4 class="mb-4 text-center text-primary fw-bold">
                        <i class="fas fa-hand-holding-heart me-2"></i>تبرع الآن لدعم قضيتنا
                    </h4>

                    <p class="text-center mb-4 text-muted">
                        <i class="fas fa-info-circle me-2"></i>تبرعك يساهم في إحداث فرق حقيقي
                    </p>

                    <form method="POST" action="{{ route('donation.store') }}" style="direction: rtl;" id="donation-form">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">

                        <!-- حقل المبلغ -->
                        <div class="form-group mb-4">
                            <label for="amount" class="form-label fw-bold text-secondary" style="text-align: right; direction: rtl; display: block;">
                                <i class="fas fa-money-bill-wave me-2"></i>المبلغ (دينار أردني)
                            </label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="1" name="amount" id="amount"
                                       class="form-control py-3 border-start-0 border-end-0"
                                       placeholder="أدخل المبلغ" required>
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-donate text-primary"></i>
                                </span>
                            </div>
                            <div id="amount-error" class="error-message mt-2"></div>

                            <!-- اقتراحات مبالغ سريعة -->
                            <div class="d-flex justify-content-between mt-3 quick-amounts">
                                <button type="button" class="btn btn-outline-primary rounded-pill" style="border-color: #3cc88f; color: #3cc88f;" onclick="setAmount(5)">5 د.أ</button>
                                <button type="button" class="btn btn-outline-primary rounded-pill" style="border-color: #3cc88f; color: #3cc88f;" onclick="setAmount(10)">10 د.أ</button>
                                <button type="button" class="btn btn-outline-primary rounded-pill" style="border-color: #3cc88f; color: #3cc88f;" onclick="setAmount(20)">20 د.أ</button>
                                <button type="button" class="btn btn-outline-primary rounded-pill" style="border-color: #3cc88f; color: #3cc88f;" onclick="setAmount(50)">50 د.أ</button>
                            </div>

                        </div>

                        <!-- طريقة الدفع -->
                        <div class="payment-method-container mb-4" style="direction: rtl;">
                            <!-- العنوان مع أيقونة -->
                            <label for="payment_method_id" class="payment-method-label">
                                <i class="fas fa-credit-card"></i>
                                <span class="ms-2">طريقة الدفع</span>
                            </label>

                            <!-- حقل الاختيار -->
                            <div class="payment-method-select-wrapper">
                                <select name="payment_method_id" id="payment_method_id"
                                        class="payment-method-select" required>
                                    @foreach(\App\Models\PaymentMethod::all() as $method)
                                        <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                                    @endforeach
                                </select>
                                <div class="select-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>

                            <!-- رسالة الخطأ -->
                            <div id="payment-method-error" class="payment-method-error"></div>
                        </div>

                        <!-- معلومات البطاقة -->
                        <div class="form-group mb-4">
                            <div class="card border-0 shadow-sm p-3 mb-3 bg-light rounded-3">
                                <div class="card-body">
                                    <h5 class="card-title text-secondary mb-4" style="text-align: center; direction: rtl; display: block;">
                                       معلومات البطاقة
                                    </h5>

                                    <!-- اسم صاحب البطاقة -->
                                    <div class="mb-3">
                                        <label for="card_holder_name" class="form-label" style="text-align: right; direction: rtl; display: block;">اسم صاحب البطاقة</label>
                                        <input type="text" name="card_holder_name" id="card_holder_name"
                                               class="form-control py-3" placeholder="كما هو مدون على البطاقة" required>
                                        <div id="card-holder-error" class="error-message mt-2"></div>
                                    </div>

                                    <!-- رقم البطاقة -->
                                    <div class="mb-3">
                                        <label for="card_number" class="form-label" style="text-align: right; direction: rtl; display: block;">رقم البطاقة</label>
                                        <div class="input-group">
                                            <input type="text" name="card_number" id="card_number"
                                                   class="form-control py-3" placeholder="1234 5678 9012 3456" required>
                                            <span class="input-group-text bg-white">
                                                <i class="fab fa-cc-visa text-primary me-2"></i>
                                                <i class="fab fa-cc-mastercard text-danger"></i>
                                            </span>
                                        </div>
                                        <div id="card-number-error" class="error-message mt-2"></div>
                                    </div>

                                    <!-- تاريخ الانتهاء و CVC -->
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="card_expiry" class="form-label" style="text-align: right; direction: rtl; display: block;">تاريخ الانتهاء</label>
                                            <input type="text" name="card_expiry" id="card_expiry"
                                                   class="form-control py-3" placeholder="MM/YY" required>
                                            <div id="card-expiry-error" class="error-message mt-2"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="card_cvc" class="form-label" style="text-align: right; direction: rtl; display: block;">رمز الأمان (CVC)</label>
                                            <div class="input-group">
                                                <input type="text" name="card_cvc" id="card_cvc"
                                                       class="form-control py-3" placeholder="CVC" required>
                                                <span class="input-group-text bg-white">
                                                    <i class="fas fa-lock text-primary"></i>
                                                </span>
                                            </div>
                                            <div id="card-cvc-error" class="error-message mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- زر التبرع -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100 py-3 rounded-pill fw-bold shadow">
                                <i class="fas fa-hand-holding-heart me-2"></i>إتمام التبرع
                            </button>
                        </div>

                        <!-- رسالة تأكيد الأمان -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-lock me-2"></i>بياناتك محمية ومشفرة بالكامل
                            </small>
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

                <!-- السكريبتات المخصصة -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                {{-- <script>
                    $(document).ready(function() {
                        // تفعيل Flatpickr لاختيار تاريخ انتهاء البطاقة
                        flatpickr("#card_expiry", {
                            dateFormat: "m/y",
                            minDate: "today",
                        });

                        // تنسيق رقم البطاقة تلقائيًا
                        $('#card_number').on('input', function() {
                            var cardNumber = $(this).val().replace(/\s+/g, '');
                            if (cardNumber.length > 0) {
                                cardNumber = cardNumber.match(/.{1,4}/g).join(' ');
                                $(this).val(cardNumber);
                            }
                        });

                        // تعيين مبالغ سريعة
                        window.setAmount = function(amount) {
                            $('#amount').val(amount).trigger('change');
                            $('.quick-amounts button').removeClass('active');
                            $(`button[onclick="setAmount(${amount})"]`).addClass('active');
                        };

                        // التحقق من الصحة عند الإرسال
                        $('#donation-form').on('submit', function(e) {
                            e.preventDefault();
                            $('.error-message').hide();

                            let isValid = true;

                            // التحقق من المبلغ
                            const amount = parseFloat($('#amount').val());
                            if (isNaN(amount) || amount <= 0) {
                                $('#amount-error').text('الرجاء إدخال مبلغ صحيح أكبر من الصفر').show();
                                isValid = false;
                            }

                            // التحقق من اسم صاحب البطاقة
                            const cardHolder = $('#card_holder_name').val().trim();
                            if (cardHolder.length < 3) {
                                $('#card-holder-error').text('الرجاء إدخال اسم صاحب البطاقة بالكامل').show();
                                isValid = false;
                            }

                            // التحقق من رقم البطاقة (بدون مسافات)
                            const cardNumber = $('#card_number').val().replace(/\s+/g, '');
                            if (!/^\d{16}$/.test(cardNumber)) {
                                $('#card-number-error').text('رقم البطاقة يجب أن يتكون من 16 رقمًا').show();
                                isValid = false;
                            }

                            // التحقق من تاريخ الانتهاء
                            const expiry = $('#card_expiry').val();
                            if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
                                $('#card-expiry-error').text('الرجاء إدخال تاريخ صحيح بتنسيق MM/YY').show();
                                isValid = false;
                            }

                            // التحقق من رمز CVC
                            const cvc = $('#card_cvc').val();
                            if (!/^\d{3,4}$/.test(cvc)) {
                                $('#card-cvc-error').text('رمز الأمان يجب أن يتكون من 3 أو 4 أرقام').show();
                                isValid = false;
                            }

                            // إذا كانت جميع البيانات صحيحة، قم بالإرسال
                            if (isValid) {
                                const formData = $(this).serialize();

                                $.ajax({
                                    url: $(this).attr('action'),
                                    method: 'POST',
                                    data: formData,
                                    beforeSend: function() {
                                        $('button[type="submit"]').prop('disabled', true)
                                            .html('<i class="fas fa-spinner fa-spin me-2"></i>جاري المعالجة...');
                                    },
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'شكرًا لتبرعك!',
                                                text: response.message,
                                                confirmButtonText: 'تم',
                                                timer: 3000
                                            }).then(() => {
                                                if (response.redirect) {
                                                    window.location.href = response.redirect;
                                                } else {
                                                    window.location.reload();
                                                }
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'خطأ',
                                                text: response.message,
                                                confirmButtonText: 'حسنًا'
                                            });
                                        }
                                    },
                                    error: function(xhr) {
                                        let errorMessage = 'حدث خطأ غير متوقع';
                                        if (xhr.responseJSON && xhr.responseJSON.message) {
                                            errorMessage = xhr.responseJSON.message;
                                        }
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'خطأ',
                                            text: errorMessage,
                                            confirmButtonText: 'حسنًا'
                                        });
                                    },
                                    complete: function() {
                                        $('button[type="submit"]').prop('disabled', false)
                                            .html('<i class="fas fa-hand-holding-heart me-2"></i>إتمام التبرع');
                                    }
                                });
                            }
                        });

                        // إذا تم الوصول إلى الهدف
                        @if($cause->raised_amount >= $cause->goal_amount)
                            $('button[type="submit"]').prop('disabled', true)
                                .html('<i class="fas fa-check-circle me-2"></i>تم الوصول إلى الهدف')
                                .removeClass('btn-primary')
                                .addClass('btn-success');
                        @endif
                    });
                </script> --}}
                {{-- <script>
                    $(document).ready(function() {
                        // تفعيل Flatpickr لاختيار تاريخ انتهاء البطاقة
                        flatpickr("#card_expiry", {
                            dateFormat: "m/y",
                            minDate: "today",
                        });

                        // تنسيق رقم البطاقة تلقائيًا
                        $('#card_number').on('input', function() {
                            var cardNumber = $(this).val().replace(/\s+/g, '');
                            if (cardNumber.length > 0) {
                                cardNumber = cardNumber.match(/.{1,4}/g).join(' ');
                                $(this).val(cardNumber);
                            }
                        });

                        // تعيين مبالغ سريعة
                        window.setAmount = function(amount) {
                            $('#amount').val(amount).trigger('change');
                            $('.quick-amounts button').removeClass('active');
                            $(`button[onclick="setAmount(${amount})"]`).addClass('active');
                        };

                        // التحقق من الصحة عند الإرسال
                        $('#donation-form').on('submit', function(e) {
                            e.preventDefault();
                            $('.error-message').hide();

                            // التحقق أولاً مما إذا كان المستخدم مسجلاً دخول
                            @if(!auth()->check())
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'يجب تسجيل الدخول',
                                    text: 'يجب عليك تسجيل الدخول أولاً لإتمام عملية التبرع',
                                    confirmButtonText: 'تسجيل الدخول',
                                    showCancelButton: true,
                                    cancelButtonText: 'إلغاء'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('login') }}";
                                    }
                                });
                                return false;
                            @endif

                            let isValid = true;

                            // التحقق من المبلغ
                            const amount = parseFloat($('#amount').val());
                            if (isNaN(amount) || amount <= 0) {
                                $('#amount-error').text('الرجاء إدخال مبلغ صحيح أكبر من الصفر').show();
                                isValid = false;
                            }

                            // التحقق من اسم صاحب البطاقة
                            const cardHolder = $('#card_holder_name').val().trim();
                            if (cardHolder.length < 3) {
                                $('#card-holder-error').text('الرجاء إدخال اسم صاحب البطاقة بالكامل').show();
                                isValid = false;
                            }

                            // التحقق من رقم البطاقة (بدون مسافات)
                            const cardNumber = $('#card_number').val().replace(/\s+/g, '');
                            if (!/^\d{16}$/.test(cardNumber)) {
                                $('#card-number-error').text('رقم البطاقة يجب أن يتكون من 16 رقمًا').show();
                                isValid = false;
                            }

                            // التحقق من تاريخ الانتهاء
                            const expiry = $('#card_expiry').val();
                            if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
                                $('#card-expiry-error').text('الرجاء إدخال تاريخ صحيح بتنسيق MM/YY').show();
                                isValid = false;
                            }

                            // التحقق من رمز CVC
                            const cvc = $('#card_cvc').val();
                            if (!/^\d{3,4}$/.test(cvc)) {
                                $('#card-cvc-error').text('رمز الأمان يجب أن يتكون من 3 أو 4 أرقام').show();
                                isValid = false;
                            }

                            // إذا كانت جميع البيانات صحيحة، قم بالإرسال
                            if (isValid) {
                                const formData = $(this).serialize();

                                $.ajax({
                                    url: $(this).attr('action'),
                                    method: 'POST',
                                    data: formData,
                                    beforeSend: function() {
                                        $('button[type="submit"]').prop('disabled', true)
                                            .html('<i class="fas fa-spinner fa-spin me-2"></i>جاري المعالجة...');
                                    },
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'شكرًا لتبرعك!',
                                                text: response.message,
                                                confirmButtonText: 'تم',
                                                timer: 3000
                                            }).then(() => {
                                                if (response.redirect) {
                                                    window.location.href = response.redirect;
                                                } else {
                                                    window.location.reload();
                                                }
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'خطأ',
                                                text: response.message,
                                                confirmButtonText: 'حسنًا'
                                            });
                                        }
                                    },
                                    error: function(xhr) {
                                        let errorMessage = 'حدث خطأ غير متوقع';
                                        if (xhr.responseJSON && xhr.responseJSON.message) {
                                            errorMessage = xhr.responseJSON.message;
                                        }
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'خطأ',
                                            text: errorMessage,
                                            confirmButtonText: 'حسنًا'
                                        });
                                    },
                                    complete: function() {
                                        $('button[type="submit"]').prop('disabled', false)
                                            .html('<i class="fas fa-hand-holding-heart me-2"></i>إتمام التبرع');
                                    }
                                });
                            }
                        });

                        // إذا تم الوصول إلى الهدف
                        @if($cause->raised_amount >= $cause->goal_amount)
                            $('button[type="submit"]').prop('disabled', true)
                                .html('<i class="fas fa-check-circle me-2"></i>تم الوصول إلى الهدف')
                                .removeClass('btn-primary')
                                .addClass('btn-success');
                        @endif

                        // إخفاء حقول معلومات البطاقة إذا لم يكن المستخدم مسجلاً
                        @if(!auth()->check())
                            $(document).ready(function() {
                                $('.card-body').hide();
                                $('#donation-form').prepend(
                                    '<div class="alert alert-warning text-center mb-4">' +
                                    '<i class="fas fa-exclamation-triangle me-2"></i>' +
                                    'يجب عليك <a href="{{ route('login') }}" class="alert-link">تسجيل الدخول</a> أولاً لإتمام عملية التبرع' +
                                    '</div>'
                                );
                            });
                        @endif
                    });
                </script> --}}
                <script>
                    $(document).ready(function() {
                        // تفعيل Flatpickr لاختيار تاريخ انتهاء البطاقة
                        flatpickr("#card_expiry", {
                            dateFormat: "m/y",
                            minDate: "today",
                        });

                        // تنسيق رقم البطاقة تلقائيًا
                        $('#card_number').on('input', function() {
                            var cardNumber = $(this).val().replace(/\s+/g, '');
                            if (cardNumber.length > 0) {
                                cardNumber = cardNumber.match(/.{1,4}/g).join(' ');
                                $(this).val(cardNumber);
                            }
                        });

                        // تعيين مبالغ سريعة
                        window.setAmount = function(amount) {
                            $('#amount').val(amount).trigger('change');
                            $('.quick-amounts button').removeClass('active');
                            $(`button[onclick="setAmount(${amount})"]`).addClass('active');
                        };

                        // التحقق من الصحة عند الإرسال
                        $('#donation-form').on('submit', function(e) {
                            e.preventDefault();
                            $('.error-message').hide();

                            // التحقق أولاً مما إذا كان المستخدم مسجلاً دخول
                            @if(!auth()->check())
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'يجب تسجيل الدخول',
                                    text: 'يجب عليك تسجيل الدخول أولاً لإتمام عملية التبرع',
                                    confirmButtonText: 'تسجيل الدخول',
                                    showCancelButton: true,
                                    cancelButtonText: 'إلغاء'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('login') }}";
                                    }
                                });
                                return false;
                            @endif

                            let isValid = true;

                            // التحقق من المبلغ
                            const amount = parseFloat($('#amount').val());
                            if (isNaN(amount) || amount <= 0) {
                                $('#amount-error').text('الرجاء إدخال مبلغ صحيح أكبر من الصفر').show();
                                isValid = false;
                            }

                            // التحقق من اسم صاحب البطاقة
                            const cardHolder = $('#card_holder_name').val().trim();
                            if (cardHolder.length < 3) {
                                $('#card-holder-error').text('الرجاء إدخال اسم صاحب البطاقة بالكامل').show();
                                isValid = false;
                            }

                            // التحقق من رقم البطاقة (بدون مسافات)
                            const cardNumber = $('#card_number').val().replace(/\s+/g, '');
                            if (!/^\d{16}$/.test(cardNumber)) {
                                $('#card-number-error').text('رقم البطاقة يجب أن يتكون من 16 رقمًا').show();
                                isValid = false;
                            }

                            // التحقق من تاريخ الانتهاء
                            const expiry = $('#card_expiry').val();
                            if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
                                $('#card-expiry-error').text('الرجاء إدخال تاريخ صحيح بتنسيق MM/YY').show();
                                isValid = false;
                            }

                            // التحقق من رمز CVC
                            const cvc = $('#card_cvc').val();
                            if (!/^\d{3,4}$/.test(cvc)) {
                                $('#card-cvc-error').text('رمز الأمان يجب أن يتكون من 3 أو 4 أرقام').show();
                                isValid = false;
                            }

                            // إذا كانت جميع البيانات صحيحة، قم بالإرسال
                            if (isValid) {
                                const formData = $(this).serialize();

                                $.ajax({
                                    url: $(this).attr('action'),
                                    method: 'POST',
                                    data: formData,
                                    beforeSend: function() {
                                        $('button[type="submit"]').prop('disabled', true)
                                            .html('<i class="fas fa-spinner fa-spin me-2"></i>جاري المعالجة...');
                                    },
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'شكرًا لتبرعك!',
                                                text: response.message,
                                                confirmButtonText: 'تم',
                                                timer: 3000
                                            }).then(() => {
                                                if (response.redirect) {
                                                    window.location.href = response.redirect;
                                                } else {
                                                    window.location.reload();
                                                }
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'خطأ',
                                                text: response.message,
                                                confirmButtonText: 'حسنًا'
                                            });
                                        }
                                    },
                                    error: function(xhr) {
                                        let errorMessage = 'حدث خطأ غير متوقع';
                                        if (xhr.responseJSON && xhr.responseJSON.message) {
                                            errorMessage = xhr.responseJSON.message;
                                        }
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'خطأ',
                                            text: errorMessage,
                                            confirmButtonText: 'حسنًا'
                                        });
                                    },
                                    complete: function() {
                                        $('button[type="submit"]').prop('disabled', false)
                                            .html('<i class="fas fa-hand-holding-heart me-2"></i>إتمام التبرع');
                                    }
                                });
                            }
                        });

                        // إذا تم الوصول إلى الهدف
                        @if($cause->raised_amount >= $cause->goal_amount)
                            $('button[type="submit"]').prop('disabled', true)
                                .html('<i class="fas fa-check-circle me-2"></i>تم الوصول إلى الهدف')
                                .removeClass('btn-primary')
                                .addClass('btn-success');
                        @endif

                        // إخفاء كامل قسم الدفع إذا لم يكن المستخدم مسجلاً
                        @if(!auth()->check())
                            $(document).ready(function() {
                                // إخفاء جميع حقول الدفع
                                $('#amount').closest('.form-group').hide();
                                $('.quick-amounts').hide();
                                $('.payment-method-container').hide();
                                $('.card').hide();
                                $('button[type="submit"]').closest('.form-group').hide();

                                // إضافة رسالة تسجيل الدخول
                                $('#donation-form').prepend(
                                    '<div class="alert alert-warning text-center mb-4 p-4">' +
                                    '<i class="fas fa-exclamation-triangle fa-2x mb-3"></i>' +
                                    '<h4 class="alert-heading">يجب تسجيل الدخول</h4>' +
                                    '<p>يجب عليك تسجيل الدخول أولاً لإتمام عملية التبرع</p>' +
                                    '<a href="{{ route('login') }}" class="btn btn-primary mt-2">' +
                                    '<i class="fas fa-sign-in-alt me-2"></i>تسجيل الدخول</a>' +
                                    '</div>'
                                );
                            });
                        @endif
                    });
                </script>

                <style>

                   .quick-amounts .btn:hover {
                        background-color: #3cc88f;  /* تغيير خلفية الزر إلى اللون المطلوب */
                        color: white !important;
                        border-color: #3cc88f;      /* تأكيد أن الحدود تظل بنفس اللون */
                     }
                    .payment-method-container {
                        font-family: 'Tajawal', sans-serif;
                    }

                    .payment-method-label {
                        text-align: right;
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #2c3e50;
                        font-size: 1.05rem;
                    }

                    .payment-method-label i {
                        color: #3cc88f;
                    }

                    .payment-method-select-wrapper {
                        position: relative;
                    }

                    .payment-method-select {
                        width: 100%;
                        padding: 12px 45px 12px 15px;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        background-color: #fff;
                        font-size: 1rem;
                        color: #333;
                        appearance: none;
                        transition: all 0.3s ease;
                        cursor: pointer;
                    }

                    .payment-method-select:focus {
                        border-color: #3cc88f;
                        box-shadow: 0 0 0 3px rgba(1, 255, 77, 0.274);
                        outline: none;
                    }

                    .select-arrow {
                        position: absolute;
                        top: 50%;
                        left: 15px;
                        transform: translateY(-50%);
                        color: #7f8c8d;
                        pointer-events: none;
                    }

                    .payment-method-error {
                        color: #e74c3c;
                        font-size: 0.85rem;
                        margin-top: 5px;
                        padding-right: 5px;
                        display: none;
                    }

                    /* تأثيرات عند التحويم */
                    .payment-method-select:hover {
                        border-color: #bdc3c7;
                    }

                    /* تصميم متجاوب */
                    @media (max-width: 768px) {
                        .payment-method-select {
                            padding: 10px 40px 10px 12px;
                            font-size: 0.95rem;
                        }
                    }

                    .rounded-4 {
                        border-radius: 16px !important;
                    }

                    .bg-primary-light {
                        background-color: rgba(60, 200, 143, 0.1) !important;
                    }

                    .bg-light-hover {
                        transition: all 0.3s ease;
                    }

                    .bg-light-hover:hover {
                        background-color: #f8f9fa !important;
                        transform: translateY(-3px);
                    }

                    .bg-primary-gradient {
                        background: linear-gradient(90deg, #3cc88f 0%, #2a7d5f 100%) !important;
                    }

                    .transition-scale {
                        transition: transform 0.5s ease !important;
                    }

                    .transition-scale:hover {
                        transform: scale(1.03);
                    }

                    /* تصميم عام */
                    .inner {
                        border: 1px solid #e0e0e0;
                        transition: all 0.3s ease;
                    }

                    .inner:hover {
                        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                    }

                    /* حقول الإدخال */
                    .form-control, .form-select {
                        border-radius: 8px;
                        border: 1px solid #ddd;
                        transition: all 0.3s;
                    }

                    .form-control:focus, .form-select:focus {
                        border-color: #3cc88f;
                        box-shadow: 0 0 0 0.25rem rgba(1, 255, 77, 0.274);
                    }

                    /* رسائل الخطأ */
                    .error-message {
                        color: #dc3545;
                        font-size: 0.85rem;
                        padding: 5px 10px;
                        background-color: rgba(220, 53, 69, 0.1);
                        border-radius: 5px;
                        display: none;
                    }

                    /* أزرار المبالغ السريعة */
                    .quick-amounts button {
                        flex: 1;
                        margin: 0 5px;
                        padding: 8px 0;
                        transition: all 0.3s;
                    }

                    .quick-amounts button:hover {
                        transform: translateY(-2px);
                    }

                    /* بطاقة معلومات البطاقة */
                    .card {
                        background: linear-gradient(to right, #f8f9fa, #ffffff);
                        border: none;
                    }

                    /* زر التبرع */
                    .btn-primary {
                        background: linear-gradient(to right, #3cc88f, #2a7d5f);
                        border: none;
                        transition: all 0.3s;
                    }

                    .btn-primary:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 5px 15px rgba(108, 238, 147, 0.4);
                    }

                    /* تصميم متجاوب */
                    @media (max-width: 576px) {
                        .quick-amounts button {
                            font-size: 0.8rem;
                            padding: 5px 0;
                        }

                        .form-control, .form-select, .btn {
                            padding: 0.75rem;
                        }
                    }
                </style>
            </div>
        </div>
    </div>
</section>
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
