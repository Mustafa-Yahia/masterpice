@extends('layouts.app')

@section('content')
<section class="donate-section py-5" dir="rtl">
    <div class="auto-container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="inner p-4 shadow-sm rounded bg-white">
                    <h2 class="mb-4 text-center text-success">تفاصيل التبرع</h2>

                    <form method="POST" action="{{ route('donation.store') }}">
                        @csrf

                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">

                        <!-- عنوان الحملة -->
                        <div class="mb-4 text-center">
                            <h4 class="text-primary">{{ $cause->title }}</h4>
                            <img src="{{ asset('storage/images/' . $cause->image) }}" class="img-fluid rounded my-3" style="max-height: 250px;">
                        </div>

                        <!-- اختيار مبلغ التبرع -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">اختر المبلغ:</label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach([10, 20, 50, 100] as $amount)
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="payment-group" value="{{ $amount }}" class="d-none"> {{ $amount }} د.أ
                                    </label>
                                @endforeach
                            </div>
                            <input type="text" class="form-control mt-3" name="other-payment" placeholder="أو أدخل مبلغًا مخصصًا">
                        </div>

                        <div class="method mb-4">
                            <h4 class="mb-3">اختر طريقة الدفع</h4>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment1" value="بطاقة ائتمان" required>
                                <label class="form-check-label" for="payment1">بطاقة ائتمان / خصم مباشر</label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment2" value="محفظة إلكترونية">
                                <label class="form-check-label" for="payment2">محفظة إلكترونية (زين كاش / أورانج كاش)</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment3" value="تحويل بنكي">
                                <label class="form-check-label" for="payment3">تحويل بنكي</label>
                            </div>
                        </div>


                        <!-- إرسال -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5">تبرع الآن</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
