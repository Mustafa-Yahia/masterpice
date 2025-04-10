{{-- <!DOCTYPE html>
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


        <!-- Header Upper -->
        <div class="header-upper">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <!--Logo-->
                    <div class="logo-box">
                        <div class="logo"><a href="index.html" title="LoveUs - Charity and Fundraising HTML Template">        <img src="{{ asset('images/logo.png') }}" alt="LoveUs - Charity and Fundraising HTML Template" title="LoveUs - Charity and Fundraising HTML Template">
                        </a></div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>
                        <div class="link-box clearfix">
                            <div class="auth-links d-flex align-items-center gap-3">


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
                                        <span class="btn-title ">تسجيل الدخول</span>
                                    </a>
                                    <a href="{{ route('register') }}" class="theme-btn btn-style-one" style="font-size: 12px; margin: 1px">
                                        <span class="btn-title">إنشاء حساب</span>
                                    </a>
                                @endauth


                            </div>
                        </div>

                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li><a href="">الرئيسية</a></li>
                                    <li><a href="{{ route('cause.index') }}">تبرع</a></li>

                                    <li><a href="{{ route('volunteer.form') }}">التطوع</a></li>

                                    <li class="dropdown"><a href="#">الإعلام</a>
                                        <ul>
                                            <li><a href="gallery.html">معرض الصور</a></li>
                                            <li><a href="blog.html">المدونة</a></li>
                                        </ul>
                                    </li>


                                    <li class="dropdown"><a href="#">برامجنا</a>
                                        <ul>
                                            <li><a href="eradicate-hunger.html">مشروع القضاء على الجوع</a></li>
                                            <li><a href="feeding-programs.html">برامج التغذية</a></li>
                                            <li><a href="volunteering-programs.html">برامج التطوع</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                        <!-- Main Menu End-->




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

  --}}

@extends('layouts.app')

@section('content')

<!-- Causes Section Two -->
<section class="causes-section-two">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>الأسباب الشعبية</h2>
            <div class="text">Cupidatat non proident sunt</div>
        </div>

        <!-- فلتر البحث -->
        <div class="filter-form">
            <form method="GET" action="{{ route('cause.index') }}">
                <div class="filter-row">
                    <!-- فلتر العنوان -->
                    <div class="form-group">
                        <label for="title">البحث حسب العنوان</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="أدخل كلمة بحث في العنوان" value="{{ request('title') }}" oninput="this.form.submit()">
                    </div>

                    <!-- فلتر المبلغ الذي تم جمعه -->
                    <div class="form-group">
                        <label for="raised_amount">المبلغ الذي تم جمعه</label>
                        <input type="number" name="raised_amount" id="raised_amount" class="form-control" placeholder="أدخل المبلغ الذي تم جمعه" value="{{ request('raised_amount') }}" oninput="this.form.submit()">
                    </div>

                    <!-- فلتر الهدف -->
                    <div class="form-group">
                        <label for="goal_amount">الهدف</label>
                        <input type="number" name="goal_amount" id="goal_amount" class="form-control" placeholder="أدخل الهدف" value="{{ request('goal_amount') }}" oninput="this.form.submit()">
                    </div>

                    <!-- فلتر الفئة -->
                    <div class="form-group">
                        <label for="category">الفئة</label>
                        <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                            <option value="">اختر الفئة</option>
                            <option value="Education" {{ request('category') == 'Education' ? 'selected' : '' }}>التعليم</option>
                            <option value="مرضى" {{ request('category') == 'مرضى' ? 'selected' : '' }}>مرضى</option>
                            <option value="طلاب جامعة" {{ request('category') == 'طلاب جامعة' ? 'selected' : '' }}>طلاب جامعة</option>
                        </select>
                    </div>

                    <!-- فلتر التاريخ النهائي -->
                    <div class="form-group">
                        <label for="end_time">التاريخ النهائي</label>
                        <input type="date" name="end_time" id="end_time" class="form-control" value="{{ request('end_time') }}" onchange="this.form.submit()">
                    </div>
                </div>
            </form>
        </div>

        <div class="row clearfix">
            <!-- عرض التبرعات بعد تطبيق الفلاتر -->
            @foreach($causes as $cause)
                <!-- Cause Block -->
                <div class="cause-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms">
                        <div class="image-box">
                            <figure class="image">
                                <a href="{{ route('cause.show', $cause->id) }}">
                                    <img class="img-fluid" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">
                                </a>
                            </figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="{{ route('cause.show', $cause->id) }}">{{ $cause->title }}</a></h3>
                            <div class="text">{{ $cause->description }}</div>
                        </div>
                        <div class="donate-info">
                            <div class="progress-box">
                                <div class="bar">
                                    <div class="bar-inner count-bar" data-percent="{{ $cause->raised_amount / $cause->goal_amount * 100 }}%">
                                        <div class="count-text">{{ number_format($cause->raised_amount / $cause->goal_amount * 100, 0) }}%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="donation-count clearfix">
                                <span class="raised"><strong>تم جمع:</strong> ${{ $cause->raised_amount }}</span>
                                <span class="goal"><strong>الهدف:</strong> ${{ $cause->goal_amount }}</span>
                            </div>
                            <div class="link-box">
                                <a href="{{ route('cause.show', $cause->id) }}" class="theme-btn btn-style-two"><span class="btn-title">اقرأ المزيد</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

@endsection

<style>
    /* إضافة تنسيق الفلاتر لظهورها بجانب بعضها */
    .filter-form {
        margin-bottom: 30px;
    }

    .filter-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 15px;  /* مسافة بين الفلاتر */
    }

    .form-group {
        flex: 1;
        min-width: 200px;
        max-width: 300px; /* الحد الأقصى لعرض الفلاتر */
        margin-bottom: 15px;
        text-align: right;  /* محاذاة النص والحقول إلى اليمين */
    }

    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        text-align: right;  /* محاذاة النص إلى اليمين */
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 1px;
        border: 1px solid #ccc;
        border-radius: 4px;
        direction: rtl;  /* جعل الحقول تظهر من اليمين لليسار */
    }



    .theme-btn.btn-style-one:hover {
        background-color: #37b785;
    }

    /* تصميم بطاقات التبرعات */
    .cause-block-two {
        margin-bottom: 30px;  /* إضافة مسافة بين البطاقات */
    }

    .cause-block-two .inner-box {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .cause-block-two .image-box img {
        width: 100%;
        height: 200px;  /* ثابت لضمان أن جميع الصور متساوية الحجم */
        object-fit: cover;
    }

    .cause-block-two .lower-content {
        margin-top: 15px;
        flex-grow: 1;
    }

    .cause-block-two .donate-info {
        margin-top: 10px;
    }

</style>
