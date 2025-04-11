@extends('layouts.app')

@section('content')

<!-- صفحة تفاصيل الحملة -->
<section class="page-banner">
    <div class="image-layer lazy-image" data-bg="url('{{ asset('images/background/bg-banner-1.jpg') }}')"></div>
    <div class="bottom-rotten-curve"></div>

    <div class="auto-container text-end" dir="rtl">
        <h1 class="display-5 fw-bold text-white wow fadeInUp">{{ $cause->title }}</h1>
        <ul class="bread-crumb clearfix mt-2">
            <li><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="active">{{ $cause->title }}</li>
        </ul>
    </div>
</section>

<section class="donate-section py-5 bg-light" dir="rtl">
    <div class="auto-container">
        <div class="row gy-5 align-items-start">
            <!-- تفاصيل الحملة -->
            <div class="col-lg-7">
                <div class="p-4 rounded bg-white shadow-sm wow fadeInUp">
                    <h2 class="mb-4 text-primary">{{ $cause->title }}</h2>

                    <img class="img-fluid rounded mb-4" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">

                    <div class="mb-3">
                        <h5 class="fw-bold">الوصف:</h5>
                        <p class="text-muted">{{ $cause->description }}</p>
                    </div>

                    @if(!empty($cause->additional_details))
                        <div class="mb-4">
                            <h5 class="fw-bold">تفاصيل إضافية:</h5>
                            <div class="p-3 rounded bg-light border text-muted" style="font-size: 15px; line-height: 1.7;">
                                {{ $cause->additional_details }}
                            </div>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">القسم:</h6>
                            <p class="text-muted">{{ $cause->category }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">تاريخ انتهاء الحملة:</h6>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($cause->end_time)->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold">التبرعات:</h6>
                        <p><strong>تم جمع:</strong> {{ number_format($cause->raised_amount, 2) }} د.أ</p>
                        <p><strong>الهدف:</strong> {{ number_format($cause->goal_amount, 2) }} د.أ</p>
                    </div>

                    @php
                        $percent = $cause->goal_amount > 0 ? ($cause->raised_amount / $cause->goal_amount) * 100 : 0;
                    @endphp
                    <div class="progress mb-4" style="height: 22px; border-radius: 12px; overflow: hidden;">
                        <div class="progress-bar bg-success text-end px-3 d-flex align-items-center justify-content-end" role="progressbar"
                             style="width: {{ $percent }}%; transition: width 1.5s ease-in-out; font-weight: bold;"
                             aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($percent, 0) }}%
                        </div>
                    </div>
                </div>
            </div>

            <!-- معلومات المسؤول -->
            <div class="col-lg-5">
                <div class="p-4 rounded bg-white border shadow-sm wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="mb-3">المسؤول عن الحملة</h4>
                    <ul class="list-unstyled text-muted mb-4">
                        <li class="mb-2"><strong>الاسم:</strong> {{ $cause->user->name ?? 'غير محدد' }}</li>
                        <li><strong>البريد الإلكتروني:</strong> {{ $cause->user->email ?? 'غير متوفر' }}</li>
                    </ul>

                    <hr>
                    <h5 class="mb-3">شارك الحملة:</h5>
                    <div class="d-flex gap-2">
                        <a href="https://wa.me/?text={{ urlencode(route('cause.show', $cause->id)) }}" target="_blank" class="btn btn-outline-success w-100">واتساب</a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('cause.show', $cause->id)) }}" target="_blank" class="btn btn-outline-primary w-100">فيسبوك</a>
                    </div>
                </div>

                <!-- نموذج التبرع -->
                <div class="inner p-4 mt-4 bg-white rounded shadow-sm wow fadeInUp" data-wow-delay="0.4s">
                    <h4 class="mb-4">تبرع الآن</h4>

                    <form method="POST" action="{{ route('donation.store') }}" style="direction: rtl;">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">

                        <div class="form-group mb-3">
                            <label for="amount">المبلغ (د.أ)</label>
                            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="payment_method_id">طريقة الدفع</label>
                            <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                @foreach(\App\Models\PaymentMethod::all() as $method)
                                    <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>معلومات البطاقة</label>
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
@endsection
