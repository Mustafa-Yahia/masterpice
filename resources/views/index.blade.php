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
        <div class="sec-title centered mb-5">
            <h2 style="font-family: 'Cairo', sans-serif; font-weight: 600; text-align:center">كن سببًا في تغيير حياة الآخرين</h2>
            <div class="text" style="font-family: 'Cairo', sans-serif; font-size: 16px; line-height: 1.5;">تبرعك اليوم يمكن أن يصنع فرقًا كبيرًا في حياة محتاج، لا تتردد في أن تكون سببًا في الأمل.</div>
        </div>

        <div id="causes-list" class="row gy-4">
            @foreach($causes->take(6) as $cause)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden d-flex flex-column cause-card">
                        <!-- Badge for urgent causes -->
                        @if($cause->is_urgent)
                        <div class="urgent-badge">
                            <span class="badge bg-danger py-2 px-3 rounded-pill pulse-animation">
                                <i class="fas fa-exclamation-circle me-1"></i> حملة عاجلة
                            </span>
                        </div>
                        @endif

                        <!-- Image with hover effect -->
                        <a href="{{ route('cause.show', $cause->id) }}" class="cause-image-link">
                            <img class="card-img-top cause-image" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}" loading="lazy">
                            <div class="image-overlay">
                                <span class="view-details-btn">عرض التفاصيل</span>
                            </div>
                        </a>

                        <!-- Content -->
                        <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h5 class="card-title text-primary">{{ $cause->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($cause->description, 100) }}</p>

                                <div class="d-flex justify-content-between mt-3 small text-secondary">
                                    <span><i class="fa fa-tag me-1"></i> {{ $cause->category }}</span>
                                    <span><i class="fa fa-map-marker-alt me-1"></i> {{ $cause->location }}</span>
                                </div>

                                <!-- Progress with animation -->
                                <div class="mt-3 progress-container">
                                    @php
                                        $percentage = $cause->goal_amount > 0
                                            ? ($cause->raised_amount / $cause->goal_amount) * 100
                                            : 0;
                                    @endphp

                                    <div class="progress position-relative" style="height: 20px; background-color: #f1f1f1;">
                                        <div class="progress-bar bg-success progress-animate"
                                             role="progressbar"
                                             style="width: 0;"
                                             data-percentage="{{ $percentage }}"
                                             aria-valuenow="{{ $cause->raised_amount }}"
                                             aria-valuemin="0"
                                             aria-valuemax="{{ $cause->goal_amount }}">
                                            {{ convertToArabic(number_format($percentage, 0)) }}%
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-2 small">
                                        <span><strong>تم جمع:</strong> {{ convertToArabic(number_format($cause->raised_amount)) }} د.أ</span>
                                        <span><strong>الهدف:</strong> {{ convertToArabic(number_format($cause->goal_amount)) }} د.أ</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Button with hover effect -->
                            <div class="mt-4 mt-auto">
                                <a href="{{ route('cause.show', $cause->id) }}"
                                   class="btn w-100 rounded-pill read-more-btn">
                                    اقرأ المزيد
                                    <i class="fas fa-arrow-left ms-2 transition-all"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View More Button -->
        <div class="text-center mt-5">
            <a href="{{ route('cause.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                عرض المزيد
                <i class="fas fa-arrow-left ms-2"></i>
            </a>
        </div>
    </div>
</section>





<style>
  .cause-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }

    .cause-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    /* Image Styles */
    .cause-image-link {
        position: relative;
        display: block;
        overflow: hidden;
        height: 230px;
    }

    .cause-image {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(60, 200, 143, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .view-details-btn {
        color: white;
        font-weight: bold;
        padding: 8px 16px;
        border: 2px solid white;
        border-radius: 30px;
        transform: scale(0.9);
        transition: all 0.3s ease;
    }

    .cause-image-link:hover .cause-image {
        transform: scale(1.05);
    }

    .cause-image-link:hover .image-overlay {
        opacity: 1;
    }

    .cause-image-link:hover .view-details-btn {
        transform: scale(1);
    }

    /* Progress Bar Animation */
    .progress-animate {
        transition: width 1.5s ease-in-out;
    }

    /* Read More Button */
    .read-more-btn {
        border: 2px solid #3cc88f;
        color: #3cc88f;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .read-more-btn:hover {
        background-color: #3cc88f;
        color: white;
    }

    .read-more-btn .transition-all {
        transition: all 0.3s ease;
    }

    .read-more-btn:hover .transition-all {
        transform: translateX(-5px);
    }

    /* Urgent Badge */
    .urgent-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
        }
    }


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
        // Animate progress bars on scroll
        const progressBars = document.querySelectorAll('.progress-animate');

        const animateProgressBars = () => {
            progressBars.forEach(bar => {
                const percentage = bar.getAttribute('data-percentage');
                bar.style.width = percentage + '%';
            });
        };

        // Intersection Observer for progress bars
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateProgressBars();
                    observer.unobserve(entry.target);
                }
            });
        }, {threshold: 0.1});

        progressBars.forEach(bar => {
            observer.observe(bar.closest('.progress-container'));
        });

        // Add hover effect to cards
        const cards = document.querySelectorAll('.cause-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hover');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hover');
            });
        });
    });
</script>

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
