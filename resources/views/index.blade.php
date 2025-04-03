<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>LoveUs - Charity and Fundraising HTML Template | Home Page 01</title>

        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('css/color.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!--[if lt IE 9]>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <![endif]-->
        <!--[if lt IE 9]>
            <script src="{{ asset('js/respond.js') }}"></script>
        <![endif]-->
    </head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"><div class="icon"></div></div>

    <!-- Main Header -->
    <header class="main-header">
        <!-- Header Top -->
        <div class="header-top">
            <div class="auto-container">
				<div class="inner clearfix">
                    <div class="top-left">
                        <ul class="social-links clearfix">
                            <li class="social-title">Follow Us:</li>
                            <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                            <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                        </ul>
                    </div>

                    <div class="top-right">
                        <ul class="info clearfix">
                            <li class="search-btn"><button type="button" class="theme-btn search-toggler"><span class="fa fa-search"></span></button></li>
                            <li><a href="tel:12345615523"><span class="icon fa fa-phone-alt"></span> Call: &nbsp;123 4561 5523</a></li>
                            <li><a href="mailto:info@templatepath.com"><span class="icon fa fa-envelope"></span> Email: &nbsp;info@loveuscharity.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Upper -->
        <div class="header-upper">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <!--Logo-->
                    <div class="logo-box">
                        <div class="logo"><a href="index.html" title="LoveUs - Charity and Fundraising HTML Template"><img src="images/logo.png" alt="LoveUs - Charity and Fundraising HTML Template" title="LoveUs - Charity and Fundraising HTML Template"></a></div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li><a href="">أنواع التبرعات</a></li>

                                    <li><a href="{{ route('volunteer.form') }}">التطوع</a></li>

                                    <li class="dropdown"><a href="#">الإعلام</a>
                                        <ul>
                                            <li><a href="gallery.html">معرض الصور</a></li>
                                            <li><a href="blog.html">المدونة</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="donation-tools.html">أدوات التبرع</a></li>

                                    <li class="dropdown"><a href="#">برامجنا</a>
                                        <ul>
                                            <li><a href="eradicate-hunger.html">مشروع القضاء على الجوع</a></li>
                                            <li><a href="feeding-programs.html">برامج التغذية</a></li>
                                            <li><a href="volunteering-programs.html">برامج التطوع</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="contact.html">اتصل بنا</a></li>
                                </ul>
                            </div>
                        </nav>

                        <!-- Main Menu End-->

                        <div class="link-box clearfix">
                            <div class="auth-links d-flex align-items-center gap-3">
                                {{-- <div class="cart-link">
                                    <a href="shopping-cart.html" class="theme-btn">
                                        <span class="icon flaticon-paper-bag"></span>
                                    </a>
                                </div> --}}

                                @auth
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; font-size: 18px; font-weight: bold; padding: 5px 10px; text-align: left;">


                                            <span class="text-dark">مرحباً، {{ Auth::user()->name }}</span>
                                            <img src="{{ asset(Auth::user()->profile_image ?? 'images/default-user.png') }}" class="rounded-circle" width="40" height="40" alt="User Image" style="margin-right: 10px;">
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="min-width: 150px;">
                                            <li><a class="dropdown-item" href="">الملف الشخصي</a></li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @else
                                    <a href="{{ route('login') }}" class="theme-btn btn-style-one" style="font-size: 12px; margin: 1px;">
                                        <span class="btn-title">تسجيل الدخول</span>
                                    </a>
                                    <a href="{{ route('register') }}" class="theme-btn btn-style-one" style="font-size: 12px; margin: 1px">
                                        <span class="btn-title">إنشاء حساب</span>
                                    </a>
                                @endauth


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="index.html" title=""><img src="images/sticky-logo.png" alt="" title=""></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
                </div>
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-cancel"></span></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href="index.html"><img src="images/logo.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="#"><span class="fab fa-twitter"></span></a></li>
						<li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a href="#"><span class="fab fa-instagram"></span></a></li>
						<li><a href="#"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!-- End Main Header -->


    <!-- Banner Section -->
    <section class="banner-section">
		<div class="banner-carousel love-carousel owl-theme owl-carousel" data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items" : "1" }}}'>
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
                        {{-- <div class="btn-box">
                            <a href="donate.html" class="theme-btn btn-style-one">
                                <span class="btn-title">تبرع الآن</span>
                            </a>
                        </div> --}}
                    </div>
                </div>


			<!-- Slide Item -->
			{{-- <div class="slide-item">
				<div class="image-layer lazy-image" data-bg="url('images/main-slider/2.jpg')"></div>

				<div class="auto-container">
					<div class="content-box">
						<h2>You Can Help  <br>The Poor</h2>
						<div class="text">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </div>
						<div class="btn-box"><a href="donate.html" class="theme-btn btn-style-one"><span class="btn-title">Donate Now</span></a></div>
					</div>
				</div>
			</div> --}}

			<!-- Slide Item -->
			{{-- <div class="slide-item">
				<div class="image-layer lazy-image" data-bg="url('images/main-slider/3.jpg')"></div>

				<div class="auto-container">
					<div class="content-box">
						<h2>You Can Help  <br>The Poor</h2>
						<div class="text">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </div>
						<div class="btn-box"><a href="donate.html" class="theme-btn btn-style-one"><span class="btn-title">Donate Now</span></a></div>
					</div>
				</div>
			</div> --}}

		</div>
    </section>


<!-- resources/views/index.blade.php -->
<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('content')
    <!-- التبرعات المتاحة -->
    <section class="causes-section">
        <div class="auto-container">
            <div class="sec-title centered">
                <div class="sub-title">أوجه التبرع</div>
                <h2>تبرعات متاحة</h2>
                <div class="text">ساهم في دعم المحتاجين عبر أحد هذه التبرعات</div>
            </div>

            <div class="row clearfix">
                @if($categories->isNotEmpty())
                    @foreach($categories as $category)
                        <div class="cause-block col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box d-flex flex-column wow fadeInUp" data-wow-delay="0ms" style="display: flex; flex-direction: column; height: 100%; min-height: 400px;">
                                <div class="image-box" style="flex-shrink: 0;">
                                    <figure class="image">
                                        <img class="lazy-image" src="{{ asset('storage/images/' . $category->image) }}" alt="{{ $category->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                                    </figure>
                                </div>
                                <div class="lower-content d-flex flex-column flex-grow-1" style="overflow: hidden; text-align: right;">
                                    <h3 style="text-align: center; font-size: 20px; font-weight: bold; color: #25282a; margin: 20px 0;">{{ $category->title }}</h3>
                                    <div class="text" style="overflow: hidden; text-overflow: ellipsis; max-height: 80px; margin: 0 10px; font-size: 16px; color: #555; line-height: 1.5;">
                                        {{ $category->description }}
                                    </div>
                                    <div class="link-box mt-auto" style="margin-top: auto; text-align: center;">
                                        <a href="{{ route('donation.show', $category->id) }}" class="theme-btn btn-style-two" style="display: inline-block; padding: 10px 20px; background-color: #3cc88f; color: white; border-radius: 8px; font-size: 16px;">
                                            <span class="btn-title">تبرع الآن</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>لا توجد فئات تبرع متاحة حالياً. يرجى المحاولة لاحقاً.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="causes-section-two" style="background: linear-gradient(135deg, rgba(60, 200, 143, 0.7), rgba(60, 200, 143, 0.3)), url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center; padding: 50px 0;">
        <div class="auto-container">
            <div class="sec-title centered" style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 8px;">
                <div class="sub-title" style="color: #fff;">مساعدتك تحدث فرقًا</div>
                <h2 style="color: #fff;">ساهم في تغيير حياة الآخرين</h2>
                <div class="text" style="color: #fff;">ساعد في تقديم الأمل للمرضى، الطلاب، والمحتاجين. تبرع اليوم لتكون جزءًا من التغيير!</div>
            </div>

            <!-- Carousel -->
            <div id="causesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if($causes->isNotEmpty())
                        @foreach($causes->chunk(3) as $chunk)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row clearfix">
                                    @foreach($chunk as $cause)
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="cause-block-two inner-box shadow-sm p-3 mb-4 bg-white rounded text-center {{ ($cause->raised_amount >= $cause->goal_amount || new Date() > new Date($cause->end_time)) ? 'goal-achieved' : '' }}">
                                                <div class="image-box" style="overflow: hidden; border-radius: 8px;">
                                                    <figure class="image">
                                                        <a href="{{ route('cause.show', $cause->id) }}">
                                                            <img class="img-fluid" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                                                        </a>
                                                    </figure>
                                                </div>
                                                <h3 class="mt-3">
                                                    <a href="{{ route('cause.show', $cause->id) }}" class="text-dark text-decoration-none">{{ $cause->title }}</a>
                                                </h3>
                                                <p class="text-muted text-truncate">{{ $cause->description }}</p>

                                                <!-- Progress Bar -->
                                                <!-- Progress Bar -->
<div class="progress" style="height: 15px; border-radius: 20px; position: relative;">
    <div class="progress-bar
        {{ ($cause->raised_amount / $cause->goal_amount) * 100 <= 49 ? 'red' :
        (($cause->raised_amount / $cause->goal_amount) * 100 <= 90 ? 'yellow' : 'green') }}
        {{ ($cause->raised_amount / $cause->goal_amount) * 100 >= 90 ? 'near-goal' : '' }}"
        role="progressbar"
        style="width: {{ min(($cause->raised_amount / $cause->goal_amount) * 100, 100) }}%;"
        aria-valuenow="{{ ($cause->raised_amount / $cause->goal_amount) * 100 }}"
        aria-valuemin="0" aria-valuemax="100">
        <span class="progress-text" style="position: absolute; width: 100%; text-align: center; color: black; font-weight: bold;">
            {{ round(($cause->raised_amount / $cause->goal_amount) * 100) }}%
        </span>
    </div>
</div>

<!-- رسائل تحفيزية ديناميكية -->
<div class="donation-message text-center mt-2 font-weight-bold">
    @php
        $progress = ($cause->raised_amount / $cause->goal_amount) * 100;
    @endphp
    @if($progress < 25)
        <span style="color: #ff6b6b;">🌱 كن أول من يساهم في الخير!</span>
    @elseif($progress < 50)
        <span style="color: #f6c23e;">🚀 نصف الطريق، ساعدنا لنكمل!</span>
    @elseif($progress < 75)
        <span style="color: #f39c12;">💪 نحن نقترب! تبرع ولو بالقليل.</span>
    @elseif($progress < 100)
        <span style="color: #28a745;">✨ بقي القليل جدًا للوصول للهدف!</span>
    @else
        <span style="color: #2ecc71;">🎉 شكرًا لكم، تم تحقيق الهدف!</span>
    @endif
</div>



                                                <!-- Raised and Goal Amount -->
                                                <small class="d-block mt-2">
                                                    <span style="color: black;">Raised: </span>
                                                    <span style="color:
                                                        {{
                                                            ($cause->raised_amount / $cause->goal_amount) * 100 <= 49 ? '#dc3545' :
                                                            (($cause->raised_amount / $cause->goal_amount) * 100 <= 90 ? '#ffc107' : '#28a745')
                                                        }};">
                                                        ${{ number_format($cause->raised_amount, 2) }}
                                                    </span>
                                                    <span style="color: black;"> / Goal: </span>
                                                    <span style="color: 3cc88f;">${{ number_format($cause->goal_amount, 2) }}</span>
                                                </small>

                                                <a href="{{ route('cause.show', $cause->id) }}" class="btn custom-btn mt-3 read-more-btn" data-cause-id="{{ $cause->id }}">اقرأ المزيد</a>

                                                <!-- Countdown Timer -->
                                                <div class="countdown-timer" data-end-time="{{ $cause->end_time }}" style="font-weight: bold; color: red; margin-top: 10px;">
                                                    <span class="time-remaining"></span>
                                                </div>

                                                <!-- "الهدف تحقق!" in the center with icon -->
                                                <div class="goal-achieved-center" style="display: none; position: absolute; top: 80px; left: 50%; transform: translateX(-50%); z-index: 1000;">
                                                    <i class="fas fa-check-circle" style="color: #3cc88f; font-size: 50px;"></i>
                                                    <span style="color: #3cc88f; font-size: 24px; font-weight: bold;">الهدف تحقق!</span>
                                                </div>

                                                <!-- "شكرًا لتبرعك!" when the time is up and goal not achieved -->
                                                <div class="goal-time-up-center" style="display: none;  top: 80px;">
                                                    <i class="fas fa-thumbs-up" style="color: #ffc107; font-size: 50px;"></i>
                                                    <span style="color: #ffc107; font-size: 24px; font-weight: bold;">شكرًا لتبرعك!</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p>لا توجد أسباب شائعة حاليًا. يرجى المحاولة لاحقًا.</p>
                        </div>
                    @endif
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#causesCarousel" data-bs-slide="prev" style="left: -100px;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">السابق</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#causesCarousel" data-bs-slide="next" style="right: -100px;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">التالي</span>
                </button>
            </div>
        </div>
    </section>

    <style>
        .goal-achieved {
            background-color: #d4edda; /* تغيير الخلفية عند تحقيق الهدف */
            border-color: #3cc88f;
            opacity: 0.7; /* جعل الـ card مطفأ عند تحقيق الهدف أو انتهاء الوقت */
        }

        .goal-achieved-icon {
            margin-top: 15px;
            text-align: center;
            color: #3cc88f;
        }

        .goal-achieved-icon i {
            margin-right: 5px;
        }

        .btn.custom-btn {
            background-color: #3cc88f;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .goal-achieved .btn.custom-btn {
            background-color: #3cc88f;
        }

        .countdown-timer {
            font-size: 14px;
            color: #dc3545;
            font-weight: bold;
            margin-top: 10px;
        }

        /* إضافة تنسيق للأيقونة والنص في المنتصف */
        .goal-achieved-center, .goal-time-up-center {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 1000;
        }

        .read-more-btn:disabled {
            background-color: #ccc;
            pointer-events: none;
        }



        @keyframes progressMove {
    0% { background-position: 0 0; }
    100% { background-position: 100px 100px; } /* تخفيف الحركة */
}

@keyframes glow {
    0% { box-shadow: 0 0 5px rgba(255, 255, 255, 0.3); }
    50% { box-shadow: 0 0 15px rgba(255, 255, 255, 0.5); }
    100% { box-shadow: 0 0 5px rgba(255, 255, 255, 0.3); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

/* تصميم الشريط الرئيسي */
.progress {
    height: 15px;
    border-radius: 20px;
    overflow: hidden;
    background-color: #e0e0e0;
    position: relative;
    box-shadow: inset 0px 0px 5px rgba(0, 0, 0, 0.1);
}

/* تحسين شريط التقدم */
.progress-bar {
    height: 100%;
    background-size: 30px 30px;
    border-radius: 20px;
    animation: progressMove 6s linear infinite;
}

/* ألوان أكثر هدوءًا */
.progress-bar.red { background: repeating-linear-gradient(45deg, #fff5f5 10%, #ff6b6b 40%); }
.progress-bar.yellow { background: repeating-linear-gradient(45deg, #fffbe6 10%, #f6c23e 40%); }
.progress-bar.green { background: repeating-linear-gradient(45deg, #e6fbe6 10%, #28a745 40%); }

/* تأثير ناعم عند الاقتراب من الهدف */
.progress-bar.near-goal {
    animation: glow 1.5s infinite alternate;
}


    </style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const timers = document.querySelectorAll(".countdown-timer");

    function convertToArabicNumerals(number) {
        const arabicNumerals = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return number.toString().split('').map(digit => arabicNumerals[parseInt(digit)]).join('');
    }

    timers.forEach(timer => {
        const endTimeAttr = timer.getAttribute("data-end-time");
        if (!endTimeAttr) return;

        const endTime = new Date(endTimeAttr).getTime();
        if (isNaN(endTime)) return;

        function updateCountdown() {
            let now = new Date().getTime();
            let timeDiff = endTime - now;

            const causeBlock = timer.closest(".cause-block-two");
            if (!causeBlock) return;

            const goalAchievedText = causeBlock.querySelector(".goal-achieved-center");
            const goalTimeUpText = causeBlock.querySelector(".goal-time-up-center");
            const progressBar = causeBlock.querySelector(".progress-bar");
            const readMoreBtn = causeBlock.querySelector(".read-more-btn");

            let progressWidth = progressBar ? parseInt(progressBar.style.width) || 0 : 0;

            // ✅ إذا كانت نسبة التقدم 100% أثناء العد التنازلي، يتم:
            if (progressWidth === 100) {
                if (goalAchievedText) goalAchievedText.style.display = 'block';
                if (goalTimeUpText) goalTimeUpText.style.display = 'none';

                // ✅ تعطيل زر "اقرأ المزيد" بدون إخفائه
                if (readMoreBtn) {
                    readMoreBtn.disabled = true;
                    readMoreBtn.style.backgroundColor = "#ccc"; // لون مميز
                    readMoreBtn.style.pointerEvents = "none"; // تعطيل التفاعل
                }
            } else {
                if (goalTimeUpText) goalTimeUpText.style.display = 'none';
                if (goalAchievedText) goalAchievedText.style.display = 'none';

                // ✅ إعادة تفعيل الزر إذا لم تصل النسبة إلى 100%
                if (readMoreBtn) {
                    readMoreBtn.disabled = false;
                    readMoreBtn.style.backgroundColor = ""; // إعادة اللون الأصلي
                    readMoreBtn.style.pointerEvents = "auto"; // تمكين التفاعل
                }
            }

            if (timeDiff <= 0) {
                timer.innerHTML = "<span style='color: green;'>انتهى وقت التبرع</span>";

                causeBlock.classList.add("goal-achieved");

                // ✅ عند انتهاء الوقت، يتم عرض الرسالة الصحيحة بناءً على نسبة التقدم
                if (progressWidth === 100) {
                    if (goalAchievedText) goalAchievedText.style.display = 'block';
                    if (goalTimeUpText) goalTimeUpText.style.display = 'none';
                } else {
                    if (goalTimeUpText) goalTimeUpText.style.display = 'block';
                    if (goalAchievedText) goalAchievedText.style.display = 'none';
                }

                // ✅ تعطيل زر "اقرأ المزيد" عند انتهاء الوقت
                if (readMoreBtn) {
                    readMoreBtn.disabled = true;
                    readMoreBtn.style.backgroundColor = "#ccc";
                    readMoreBtn.style.pointerEvents = "none";
                }

                return;
            }

            let days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            let hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

            timer.querySelector(".time-remaining").innerHTML =
                `${convertToArabicNumerals(days)} يوم ${convertToArabicNumerals(hours)} ساعة ${convertToArabicNumerals(minutes)} دقيقة ${convertToArabicNumerals(seconds)} ثانية`;

            setTimeout(updateCountdown, 1000);
        }

        updateCountdown();
    });
});

</script>





@endsection





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
