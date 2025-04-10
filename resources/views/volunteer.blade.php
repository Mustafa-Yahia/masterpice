<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LoveUs - Charity and Fundraising HTML Template | Home Page 01</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/style-2.css" rel="stylesheet">
<!-- Responsive File -->
<link href="css/responsive.css" rel="stylesheet">
<!-- Color File -->
<link href="css/color.css" rel="stylesheet">
<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
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
                            <li><a href="{{ route('index') }}">أنواع التبرعات</a></li>

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
                            <a href="{{ route('login') }}" class="theme-btn btn-style-one">
                                <span class="btn-title">تسجيل الدخول</span>
                            </a>
                            <a href="{{ route('register') }}" class="theme-btn btn-style-one">
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
    <section class="banner-section style-two">
		<div class="banner-carousel love-carousel owl-theme owl-carousel" data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items" : "1" }}}'>
			<!-- Slide Item -->
<div class="slide-item">
    <div class="image-layer lazy-image" style="background-image: url('{{ asset('storage/main-slider/tatow.jpg') }}');"></div>

    <div class="auto-container">
        <div class="content-box">
            <h2>نحن بحاجة إلى مساعدتك</h2>
            <div class="text">انضم إلى جهودنا التطوعية للمساهمة في تحسين حياة الآخرين. نحن بحاجة إلى متطوعين مثلك لتقديم الدعم والمساعدة في مشاريعنا الخيرية.</div>
            <div class="btn-box"><a href="volunteer" class="theme-btn btn-style-one"><span class="btn-title">التطوع الآن</span></a></div>
        </div>
    </div>
</div>


			<!-- Slide Item -->
<div class="slide-item">
    <div class="image-layer lazy-image" style="background-image: url('{{ asset('storage/main-slider/tataw1.jpg') }}');"></div>

    <div class="auto-container">
        <div class="content-box">
            <h2>كن جزءًا من التغيير</h2>
            <div class="text">ساهم بوقتك وجهدك في تحسين حياة الآخرين. نحن نحتاج إليك لدعم مشروعاتنا التطوعية التي تساهم في بناء مجتمع أفضل. </div>
            <div class="btn-box"><a href="volunteer" class="theme-btn btn-style-one"><span class="btn-title">التطوع الآن</span></a></div>
        </div>
    </div>
</div>


			<!-- Slide Item -->
<div class="slide-item">
    <div class="image-layer lazy-image" style="background-image: url('{{ asset('storage/main-slider/tataw2.jpg') }}');"></div>

    <div class="auto-container">
        <div class="content-box">
            <h2>ساهم في إحداث الفارق</h2>
            <div class="text">نحن بحاجة لمتطوعين مثلك للمشاركة في جهودنا الإنسانية. تبرع بوقتك وساهم في مساعدة المجتمع وتحقيق التغيير الإيجابي.</div>
            <div class="btn-box"><a href="volunteer" class="theme-btn btn-style-one"><span class="btn-title">التطوع الآن</span></a></div>
        </div>
    </div>
</div>


		</div>
    </section>
    <!--End Banner Section -->
<!-- Video Section -->
<!-- Video Section -->
<section class="video-section style-two">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Text Column -->
            <div class="text-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner">
                    <div class="sec-title text-right">
                        <div class="sub-title">شاهد الفيديو</div>
                        <h2>انضم إلى جهودنا التطوعية</h2>
                        <div class="text">
                            منذ تأسيس جمعيتنا ونحن نرحب بالمتطوعين من جميع أنحاء المملكة، من مختلف الأعمار والقطاعات الخاصة والحكومية والتعليمية وغيرها، الذين يتطلعون إلى فعل الخير والمساعدة في تحسين حياة الآخرين.
                            تطوعك معنا لا يقتصر على تقديم الدعم الغذائي فقط، بل يتعدى ذلك إلى الحفاظ على كرامة الإنسان والمساهمة في تحسين ظروفه المعيشية والنفسية.
                            نحن نفخر بأننا استقبلنا أكثر من 40,000 متطوع منذ عام 2014، الذين قدموا يد العون ودعموا المجتمع بشكل عام وأفراد الجمعية بشكل خاص.
                            إن تطوعك معنا يعني أنك تساهم في تحقيق تغيير حقيقي في حياة الآخرين. شاهد الفيديو لتتعرف أكثر على جهودنا وكيف يمكنك أن تكون جزءًا منها.
                        </div>
                        <div class="link-box clearfix text-right">
                            <a href="volunteer" class="theme-btn btn-style-one"><span class="btn-title">انضم الآن كمتطوع</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Image Column -->
            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-delay="0ms">
                    <figure class="image-box" style="background-image: url('images/resource/video-image-1.jpg'); background-size: cover; background-position: center;">
                        <img class="lazy-image" src="images/resource/image-spacer-for-validation.png" data-src="images/resource/video-image-1.jpg" alt="" style="opacity: 0;">
                        <a href="https://www.youtube.com/watch?v=GwkfEwKlIbk" class="lightbox-image over-link">
                            <span class="icon flaticon-play-button"></span>
                        </a>
                    </figure>
                </div>
            </div>

        </div>
    </div>
</section>
@extends('layouts.app')
@section('content')
<section class="volunteer-section py-5" style="background-color: #f0f4f8; direction: rtl; text-align: right;">
    <div class="container">
        <div class="sec-title text-center mb-5">
            <h2 class="fw-bold text-dark">نموذج التطوع</h2>
            <p class="text-muted">املأ النموذج التالي للانضمام إلى برامج التطوع</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('volunteer.store') }}" class="shadow p-4 bg-white rounded">
            @csrf

            <!-- المعلومات الشخصية -->
            <h5 class="fw-bold mb-3 text-dark">المعلومات الشخصية</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">الاسم الكامل</label>
                    <input type="text" name="full_name" class="form-control form-control-lg" placeholder="أدخل اسمك بالكامل" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">تاريخ الميلاد</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control form-control-lg" required>
                    <div id="age-error" class="text-danger" style="display: none;">يجب أن يكون عمرك 18 عامًا أو أكثر لتقديم الطلب.</div>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label for="phone" class="form-label d-block mb-2">رقم الهاتف</label>
                    <input type="tel" name="phone" id="phone" class="form-control form-control-lg" required>
                    <div id="phone-error" class="text-danger mt-1" style="display: none;">رقم الهاتف غير صالح. يرجى التأكد من صحة الرقم.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">الجنسية</label>
                    <div class="select-wrapper">
                        <select name="nationality" class="form-select form-select-lg" id="nationality" required>
                            <option selected disabled>اختر الجنسية</option>
                            <option value="الأردنية">الأردنية</option>
                            <option value="المصرية">المصرية</option>
                            <option value="السعودية">السعودية</option>
                            <option value="الإماراتية">الإماراتية</option>
                            <option value="البحرينية">البحرينية</option>
                            <option value="الجزائرية">الجزائرية</option>
                            <option value="السودانية">السودانية</option>
                            <option value="العمانية">العمانية</option>
                            <option value="الفلسطينية">الفلسطينية</option>
                            <option value="القطرية">القطرية</option>
                            <option value="الكويتية">الكويتية</option>
                            <option value="اللبنانية">اللبنانية</option>
                            <option value="المغربية">المغربية</option>
                            <option value="الموريتانية">الموريتانية</option>
                            <option value="اليمنية">اليمنية</option>
                            <option value="الليبية">الليبية</option>
                            <option value="الطاجيكية">الطاجيكية</option>
                            <option value="السنغالية">السنغالية</option>
                            <option value="جيبوتية">جيبوتية</option>
                            <option value="الصومالية">الصومالية</option>
                            <option value="الحدود السعودية">الحدود السعودية</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-2" id="national_id_row" style="display: none;">
                <div class="col-md-6">
                    <label for="national_id" class="form-label">رقم الهوية الوطنية</label>
                    <input type="text" name="national_id" id="national_id" class="form-control form-control-lg" placeholder="أدخل الرقم الوطني" maxlength="10">
                    <div id="national_id-error" class="text-danger mt-1" style="display: none;">الرقم الوطني غير صالح. يجب أن يتكون من 10 أرقام ويبدأ بـ "2".</div>
                </div>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-dark">التفاصيل الشخصية</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">الجنس</label>
                    <select name="gender" class="form-select form-select-lg" required>
                        <option selected disabled>اختر الجنس</option>
                        <option value="ذكر">ذكر</option>
                        <option value="أنثى">أنثى</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الدولة</label>
                    <select name="country" class="form-select form-select-lg" required>
                        <option selected disabled>اختر الدولة</option>
                        <option value="الأردن">الأردن</option>
                        <option value="مصر">مصر</option>
                        <option value="السعودية">السعودية</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">المدينة</label>
                    <input type="text" name="city" class="form-control form-control-lg" placeholder="أدخل المدينة" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">المهنة</label>
                    <select name="occupation" class="form-select form-select-lg">
                        <option selected disabled>اختر المهنة</option>
                        <option value="طالب مدرسة">طالب مدرسة</option>
                        <option value="طالب جامعة">طالب جامعة</option>
                        <option value="موظف">موظف</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-dark">معلومات الاتصال</h5>
            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="أدخل بريدك الإلكتروني" required>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-dark">برامج التطوع</h5>
            <div class="mb-3">
                <div class="d-flex flex-column gap-3">
                    @foreach ($volunteerPrograms as $program)
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="volunteer_programs[]" value="{{ $program->id }}" class="form-check-input" id="program-{{ $program->id }}">
                            <label class="form-check-label me-3" for="program-{{ $program->id }}">{{ $program->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-dark">المشاركة في التطوع</h5>
            <div class="mb-3">
                <label class="form-label">هل شاركت في التطوع خلال الثلاث سنوات الماضية؟</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input type="radio" name="previous_volunteer" value="1" class="form-check-input" id="previous_yes" onclick="toggleVolunteerField(true)" required>
                        <label class="form-check-label me-3" for="previous_yes">نعم</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="previous_volunteer" value="0" class="form-check-input" id="previous_no" onclick="toggleVolunteerField(false)" required>
                        <label class="form-check-label me-3" for="previous_no">لا</label>
                    </div>
                </div>
            </div>

            <div id="volunteer_details" class="mb-3" style="display: none;">
                <label class="form-label">ماذا تطوعت؟</label>
                <textarea name="volunteer_experience" class="form-control form-control-lg" rows="3" placeholder="أدخل تفاصيل تطوعك هنا..."></textarea>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-dark">كيف سمعت عن البرنامج؟</h5>
            <div class="mb-3">
                <select name="how_heard" class="form-select form-select-lg" style="padding-left: 50px;">
                    <option selected disabled>اختر الطريقة</option>
                    <option value="الأصدقاء">الأصدقاء</option>
                    <option value="العائلة">العائلة</option>
                    <option value="مواقع التواصل الاجتماعي">مواقع التواصل الاجتماعي</option>
                </select>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn  px-5 py-2 btn-lg" style="background-color: #3cc88f; text-color:#fff;">إرسال الطلب</button>
            </div>
        </form>
    </div>
</section>


<script src="{{ asset('js/Volunteer.js') }}" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'تم الإرسال بنجاح!',
                text: '{{ session("success") }}',
                confirmButtonText: 'حسنًا',
                timer: 5000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'خطأ في الإدخال!',
                text: '{{ session("error") }}',
                confirmButtonText: 'حسنًا',
            });
        @endif

        @if ($errors->any())
            let errorMessages = "";
            @foreach ($errors->all() as $error)
                errorMessages += "{{ $error }}\n";
            @endforeach
            Swal.fire({
                icon: 'error',
                title: 'تحقق من المدخلات!',
                text: errorMessages,
                confirmButtonText: 'حسنًا',
            });
        @endif
    });
</script>

@endsection
<style>
    .form-select.custom-select {
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
