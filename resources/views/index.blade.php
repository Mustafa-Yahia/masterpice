@extends('layouts.app')

@section('content')

<!-- Banner Section -->
<section class="banner-section">
    <div class="banner-carousel love-carousel owl-theme owl-carousel"
        data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items": "1" }}}'>
        <!-- Slide Item -->
        <div class="slide-item">
            <div class="image-layer lazy-image" style="background-image: url('{{ asset('storage/main-slider/BackgroundSider.png') }}');"></div>

            <div class="auto-container">
                <div class="content-box text-center">
                    <h2>ساهم في إسعاد المحتاجين <br> واجعل عطاؤك نورًا لحياتهم</h2>
                    <div class="text" >
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
            <!-- Right Column -->
            <div class="right-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner">
                    <div class="images clearfix">
                        <!-- عرض صور مختلفة باستخدام حلقة -->
                        <figure class="image wow fadeInRight" data-wow-delay="0ms">
                            <!-- عرض الصورة الأولى -->
                            <img class="lazy-image" src="{{ asset('storage/main-slider/PeopleFood.jpg') }}" alt="Featured Image 1" style="width: 100%; height: auto; object-fit: cover;">
                        </figure>
                        <figure class="image wow fadeInRight" data-wow-delay="300ms">
                            <!-- عرض الصورة الثانية -->
                            <img class="lazy-image" src="{{ asset('storage/main-slider/peoplehelp22.jpg') }}" alt="Featured Image 2" style="width: 100%; height: auto; object-fit: cover;">
                        </figure>
                        <figure class="image wow fadeInRight" data-wow-delay="600ms">
                            <!-- عرض الصورة الثالثة -->
                            <img class="lazy-image" src="{{ asset('storage/main-slider/peoplehelp12.jpg') }}" alt="Featured Image 3" style="width: 100%; height: auto; object-fit: cover;">
                        </figure>
                        <figure class="image wow fadeInRight" data-wow-delay="900ms">

                            <img class="lazy-image" src="{{ asset('storage/main-slider/Background11.jpg') }}" alt="Featured Image 4" style="width: 100%; height: auto; object-fit: cover;">
                        </figure>
                    </div>
                </div>
            </div>



            <!-- Left Column -->
            <div class="left-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner">
                    <div class="sec-title">
                        <h2>كن جزءاً من التغيير - قدم يد المساعدة</h2>
                        <div class="text" style="text-align:right;">موقعنا يهدف إلى جمع التبرعات للمشاريع الإنسانية التي تساهم في تحسين حياة المحتاجين في مختلف أنحاء العالم. نحن نعمل مع العديد من المؤسسات الخيرية لتنفيذ برامج طبية وتعليمية وإنسانية للحد من الفقر والمساعدة في رفع مستوى المعيشة للمجتمعات الفقيرة.</div>
                        {{-- <div class="link-box clearfix">
                            <a href="#" class="theme-btn btn-style-one" id="show-info-btn" style="float:right"><span class="btn-title">قراءة المزيد</span></a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- إضافة SweetAlert عبر CDN -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        </div>

        <div class="text-blocks">
            <div class="row g-6 clearfix">
                <div class="default-text-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner">
                        <div class="icon"><i class="fas fa-heart"></i></div>
                        <h3>مهمتنا</h3>
                        <div class="text">نهدف لتحسين حياة الأشخاص المحتاجين من خلال دعم مشاريع إنسانية في التعليم والصحة والمجتمع.</div>
                    </div>
                </div>
                <div class="default-text-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner">
                        <div class="icon"><i class="fas fa-eye"></i></div>
                        <h3>رؤيتنا</h3>
                        <div class="text">أن نكون الجسر بين الخير والمحتاجين عبر منصة موثوقة وشفافة.</div>
                    </div>
                </div>
                <div class="default-text-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner">
                        <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h3>قيمنا</h3>
                        <div class="text">نؤمن بالشفافية والإنسانية والجودة في تنفيذ جميع مشاريعنا الخيرية.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Causes Section -->
<section class="causes-section-two py-5">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2 style="font-family: 'Cairo', sans-serif; font-weight: 600; text-align:center">كن سببًا في تغيير حياة الآخرين</h2>
            <div class="text" style="font-family: 'Cairo', sans-serif; font-size: 16px; line-height: 1.5;">تبرعك اليوم يمكن أن يصنع فرقًا كبيرًا في حياة محتاج، لا تتردد في أن تكون سببًا في الأمل.</div>
        </div>

        <div class="row g-4">
            @foreach($causes->take(6) as $cause)
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="cause-block-two w-100 d-flex flex-column">
                        <div class="inner-box wow fadeInUp flex-fill d-flex flex-column">
                            <!-- صورة -->
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('cause.show', $cause->id) }}">
                                        <img class="img-fluid" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">
                                    </a>
                                </figure>
                            </div>

                            <!-- المحتوى -->
                            <div class="lower-content flex-fill" style="text-align: right;">
                                <h3 style="font-family: 'Cairo', sans-serif;">
                                    <a href="{{ route('cause.show', $cause->id) }}" style="color: Black;">{{ $cause->title }}</a>
                                </h3>
                                <div class="text" style="font-family: 'Cairo', sans-serif;">{{ Str::limit($cause->description, 100) }}</div>

                                <!-- Category and Location with Icons -->
                                <div class="meta-info" style="margin-top: 10px; display: flex; justify-content: space-between;">
                                    <div class="category" style="display: flex; align-items: center;">
                                        <i class="fa fa-tag" style="margin-left: 5px; margin-right: 5px;"></i>
                                        <span><strong>الفئة:</strong> {{ $cause->category }}</span>
                                    </div>
                                    <div class="location" style="display: flex; align-items: center;">
                                        <i class="fa fa-map-marker-alt" style="margin-left: 5px; margin-right: 5px;"></i>
                                        <span><strong>الموقع:</strong> {{ $cause->location }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- معلومات التبرع -->
                            <div class="donate-info mt-auto" style="text-align: right;">
                                <div class="progress-box">
                                    <div class="bar">
                                        <div class="bar-inner count-bar" data-percent="{{ $cause->raised_amount / $cause->goal_amount * 100 }}%">
                                            <div class="count-text">
                                                {{ convertToArabic(number_format($cause->raised_amount / $cause->goal_amount * 100, 0)) }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="donation-count clearfix" style="direction: rtl;">
                                    <span class="raised"><strong>تم جمع:</strong> {{ convertToArabic(number_format($cause->raised_amount)) }} د.أ</span>
                                    <span class="goal"><strong>الهدف:</strong> {{ convertToArabic(number_format($cause->goal_amount)) }} د.أ</span>
                                </div>

                                <div class="link-box text-center mt-3">
                                    <a href="{{ route('cause.show', $cause->id) }}" class="theme-btn btn-style-two" style="font-family: 'Cairo', sans-serif;">
                                        <span class="btn-title">اقرأ المزيد</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- زر عرض المزيد -->
        <div class="text-center mt-5">
            <a href="{{ route('cause.index') }}" class="theme-btn btn-style-one" style="font-family: 'Cairo', sans-serif;">
                <span class="btn-title">عرض المزيد</span>
            </a>
        </div>
    </div>
</section>




<style>


    .default-text-block {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
    }

    .default-text-block:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }


    .default-text-block:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .icon {
        font-size: 40px;
        color: #3cc88f;
        margin-bottom: 15px;
    }

    h3 {
        color: #3cc88f;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .text {
        font-size: 16px;
        color: #000;
    }

</style>

{{-- <script>
    // عند الضغط على الزر
    document.getElementById("show-info-btn").addEventListener("click", function(e) {
        e.preventDefault();  // منع تصرف الرابط الافتراضي

        // عرض نافذة SweetAlert تحتوي على المعلومات مع Scroll
        Swal.fire({
            title: 'معلومات عن التبرع',
            html: '<div style="max-height: 300px; overflow-y: auto; text-align: right;">موقعنا يهدف إلى جمع التبرعات للمشاريع الإنسانية التي تساهم في تحسين حياة المحتاجين في مختلف أنحاء العالم. نحن نعمل مع العديد من المؤسسات الخيرية لتنفيذ برامج طبية وتعليمية وإنسانية للحد من الفقر والمساعدة في رفع مستوى المعيشة للمجتمعات الفقيرة. نحن نسعى لتوسيع نطاق مشاريعنا في جميع أنحاء العالم ونسعى لبناء شراكات جديدة مع المنظمات غير الحكومية والمؤسسات المانحة من أجل تحسين حياة الأفراد الذين يواجهون تحديات اقتصادية وصحية كبيرة. فريقنا ملتزم بتقديم المساعدة في الحالات الإنسانية الطارئة وتوفير الدعم الكامل للمجتمعات المتضررة من الأزمات.</div>',
            icon: 'info',  // نوع الأيقونة
            confirmButtonText: 'موافق',
            confirmButtonColor: '#3cc88f'  // تخصيص لون الزر
        });
    }); --}}
{{-- </script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bar-inner').forEach(function(bar) {
            const percent = bar.getAttribute('data-percent');
            bar.style.width = percent;
        });
    });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection


{{-- @extends('layouts.app')

@section('content')

<!-- Banner Section -->
<section class="banner-section">
    <div class="banner-carousel love-carousel owl-theme owl-carousel"
        data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items" : "1" }}}'>
        <!-- Slide Item -->
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
            <!-- Right Column -->
            <div class="right-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner">
                    <div class="images clearfix">
                        @for ($i = 0; $i < 4; $i++)
                            <figure class="image wow fadeInRight" data-wow-delay="{{ $i % 2 == 0 ? '0ms' : '300ms' }}">
                                <img class="lazy-image" src="{{ asset('storage/main-slider/Background11.jpg') }}" alt="Featured Image {{ $i + 1 }}">
                            </figure>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Left Column -->
            <div class="left-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner">
                    <div class="sec-title">
                        <div class="sub-title">من نحن</div>
                        <h2>كن جزءاً من التغيير - قدم يد المساعدة</h2>
                        <div class="text">موقعنا يهدف إلى جمع التبرعات للمشاريع الإنسانية التي تساهم في تحسين حياة المحتاجين في مختلف أنحاء العالم. نحن نعمل مع العديد من المؤسسات الخيرية لتنفيذ برامج طبية وتعليمية وإنسانية للحد من الفقر والمساعدة في رفع مستوى المعيشة للمجتمعات الفقيرة.</div>
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
                        <div class="text">نهدف لتحسين حياة الأشخاص المحتاجين من خلال دعم مشاريع إنسانية في التعليم والصحة والمجتمع.</div>
                    </div>
                </div>
                <div class="default-text-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner">
                        <div class="icon"><i class="fas fa-eye"></i></div>
                        <h3>رؤيتنا</h3>
                        <div class="text">أن نكون الجسر بين الخير والمحتاجين عبر منصة موثوقة وشفافة.</div>
                    </div>
                </div>
                <div class="default-text-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner">
                        <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h3>قيمنا</h3>
                        <div class="text">نؤمن بالشفافية والإنسانية والجودة في تنفيذ جميع مشاريعنا الخيرية.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Causes Section -->
<!-- Causes Section -->
<section class="causes-section-two py-5">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>كن سببًا في تغيير حياة الآخرين</h2>
            <div class="text">تبرعك اليوم يمكن أن يصنع فرقًا كبيرًا في حياة محتاج، لا تتردد في أن تكون سببًا في الأمل.</div>
        </div>

        <div class="row g-4">
            @foreach($causes->take(6) as $cause)
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="cause-block-two w-100 d-flex flex-column">
                        <div class="inner-box wow fadeInUp flex-fill d-flex flex-column">
                            <!-- صورة -->
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('cause.show', $cause->id) }}">
                                        <img class="img-fluid" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">
                                    </a>
                                </figure>
                            </div>

                            <!-- المحتوى -->
                            <div class="lower-content flex-fill" style="text-align: right;">
                                <h3><a href="{{ route('cause.show', $cause->id) }}">{{ $cause->title }}</a></h3>
                                <div class="text">{{ Str::limit($cause->description, 100) }}</div>
                            </div>

                            <!-- معلومات التبرع -->
                            <div class="donate-info mt-auto" style="text-align: right;">
                                <div class="progress-box">
                                    <div class="bar">
                                        <div class="bar-inner count-bar"
                                             data-percent="{{ $cause->raised_amount / $cause->goal_amount * 100 }}%">
                                            <div class="count-text">
                                                {{ number_format($cause->raised_amount / $cause->goal_amount * 100, 0) }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="donation-count clearfix" style="direction: rtl;">
                                    <span class="raised"><strong>تم جمع:</strong> {{ number_format($cause->raised_amount, 2) }} د.أ</span>
                                    <span class="goal"><strong>الهدف:</strong> {{ number_format($cause->goal_amount, 2) }} د.أ</span>
                                </div>

                                <div class="link-box text-center mt-3">
                                    <a href="{{ route('cause.show', $cause->id) }}" class="theme-btn btn-style-two">
                                        <span class="btn-title">اقرأ المزيد</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- زر عرض المزيد -->
        <div class="text-center mt-5">
            <a href="{{ route('cause.index') }}" class="theme-btn btn-style-one">
                <span class="btn-title">عرض المزيد</span>
            </a>
        </div>
    </div>
</section>



<style>

    .default-text-block {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
    }

    .default-text-block:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .icon {
        font-size: 40px;
        color: #3cc88f;
        margin-bottom: 15px;
    }

    h3 {
        color: #3cc88f;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .text {
        font-size: 16px;
        color: #555;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



@endsection --}}
