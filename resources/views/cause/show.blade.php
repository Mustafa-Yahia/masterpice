@extends('layouts.app')

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

                    <div class="mb-3">
                        <h6 class="fw-bold"><i class="fas fa-donate"></i> التبرعات:</h6>
                        <p><strong>تم جمع:</strong> {{ number_format($cause->raised_amount, 2) }} د.أ</p>
                        <p><strong>الهدف:</strong> {{ number_format($cause->goal_amount, 2) }} د.أ</p>
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

@endsection
