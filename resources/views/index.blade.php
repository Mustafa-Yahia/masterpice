@extends('layouts.app')

@section('content')

<!-- Banner Section -->
<section class="banner-section">
    <div class="banner-carousel love-carousel owl-theme owl-carousel"
        data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items" : "1" }}}'>
        <div class="slide-item">
            <div class="image-layer lazy-image" style="background-image: url('{{ asset('storage/main-slider/Background11.jpg') }}');"></div>
            <div class="auto-container">
                <div class="content-box text-center">
                    <h2>ساهم في إسعاد المحتاجين <br> واجعل عطاؤك نورًا لحياتهم</h2>
                    <div class="text">
                        تبرعك اليوم يمكن أن يكون السبب في إطعام جائع، إسعاد طفل، أو إنقاذ مريض.
                        لا تنتظر، فكل لحظة تحمل فرصة لصنع فرق حقيقي في حياة الآخرين.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section style-two alternate">
    <div class="circle-one"></div>
    <div class="circle-two"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="right-column col-lg-6">
                <div class="inner">
                    <div class="images clearfix">
                        @for ($i = 0; $i < 4; $i++)
                            <figure class="image wow fadeInRight" data-wow-delay="{{ $i % 2 == 0 ? '0ms' : '300ms' }}">
                                <img class="lazy-image" src="{{ asset('storage/main-slider/Background11.jpg') }}" alt="صورة {{ $i + 1 }}">
                            </figure>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="left-column col-lg-6">
                <div class="inner">
                    <div class="sec-title">
                        <div class="sub-title">من نحن</div>
                        <h2>كن جزءاً من التغيير - قدم يد المساعدة</h2>
                        <div class="text">منصتنا تهدف لدعم المشاريع الإنسانية وتحقيق الأثر الإيجابي من خلال حملات تبرع شفافة وفعالة في جميع أنحاء الأردن.</div>
                        <div class="link-box clearfix"><a href="#" class="theme-btn btn-style-one"><span class="btn-title">قراءة المزيد</span></a></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-blocks">
            <div class="row clearfix">
                <div class="default-text-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner">
                        <div class="icon"><i class="fas fa-heart"></i></div>
                        <h3>مهمتنا</h3>
                        <div class="text">تحسين حياة الناس من خلال التبرعات والمبادرات المجتمعية التي تركز على التعليم والصحة.</div>
                    </div>
                </div>
                <div class="default-text-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner">
                        <div class="icon"><i class="fas fa-eye"></i></div>
                        <h3>رؤيتنا</h3>
                        <div class="text">أن نكون منصة موثوقة لربط أصحاب الخير بالمحتاجين بكل شفافية.</div>
                    </div>
                </div>
                <div class="default-text-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner">
                        <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h3>قيمنا</h3>
                        <div class="text">الشفافية، الإنسانية، والتميز في تقديم الحلول الخيرية.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Causes Section -->
<section class="causes-section-two py-5">
    <div class="auto-container">
        <div class="sec-title centered mb-5">
            <div class="sub-title">أسبابنا</div>
            <h2>الأسباب الشعبية</h2>
            <div class="text">اكتشف الحملات التي يدعمها مجتمعنا</div>
        </div>

        <div class="row g-4">
            @foreach($causes->take(6) as $cause)
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="cause-block-two w-100 d-flex flex-column">
                        <div class="inner-box wow fadeInUp flex-fill d-flex flex-column" data-wow-delay="0.2s" data-wow-duration="1.2s">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('cause.show', $cause->id) }}">
                                        <img class="img-fluid" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">
                                    </a>
                                </figure>
                            </div>
                            <div class="lower-content flex-fill text-end">
                                <h3><a href="{{ route('cause.show', $cause->id) }}">{{ $cause->title }}</a></h3>
                                <div class="text">{{ Str::limit($cause->description, 100) }}</div>
                            </div>
                            <div class="donate-info mt-auto text-end">
                                @php
                                    $percent = $cause->goal_amount > 0 ? ($cause->raised_amount / $cause->goal_amount) * 100 : 0;
                                @endphp
                                <div class="progress-box">
                                    <div class="bar bg-light position-relative" style="height: 10px; border-radius: 5px;">
                                        <div class="bar-inner bg-success position-absolute" style="right: 0; top: 0; bottom: 0; width: {{ $percent }}%; border-radius: 5px;">
                                            <span class="count-text position-absolute text-white px-2" style="left: 0; bottom: 20px; font-size: 13px;">
                                                {{ number_format($percent, 0) }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="donation-count clearfix" style="direction: rtl;">
                                    <span class="raised"><strong>تم جمع:</strong> {{ number_format($cause->raised_amount, 2) }} د.أ</span>
                                    <span class="goal float-start"><strong>الهدف:</strong> {{ number_format($cause->goal_amount, 2) }} د.أ</span>
                                </div>
                                <div class="link-box text-center mt-3">
                                    <a href="{{ route('cause.show', $cause->id) }}" class="btn btn-success rounded-pill px-4 py-2">
                                        <i class="fas fa-donate me-2"></i> تبرع الآن
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('cause.index') }}" class="theme-btn btn-style-one">
                <span class="btn-title">عرض المزيد</span>
            </a>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script> new WOW().init(); </script>

@endsection
