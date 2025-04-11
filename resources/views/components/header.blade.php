@props(['user'])

<!-- Header Component -->
<header class="main-header">
    <!-- Header Upper -->
    <div class="header-upper">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <!-- Logo -->
                <div class="logo-box">
                    <div class="logo">
                        <a href="/" title="منصة التبرع">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                        </a>
                    </div>
                </div>

                <!-- Nav Box -->
                <div class="nav-outer clearfix">
                    <!-- Mobile Navigation Toggler -->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                    <!-- Auth Links -->
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
                                            <form action="{{ route('logout') }}" method="POST">
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

                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="/">الرئيسية</a></li>
                                <li><a href="{{ route('cause.index') }}">تبرع</a></li>
                                <li><a href="{{ route('volunteer.form') }}">التطوع</a></li>
                                <li class="dropdown">
                                    <a href="#">الإعلام</a>
                                    <ul>
                                        <li><a href="gallery.html">معرض الصور</a></li>
                                        <li><a href="blog.html">المدونة</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#">برامجنا</a>
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
    <!-- End Header Upper -->

    <!-- Sticky Header -->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <div class="logo pull-left">
                <a href="/"><img src="images/sticky-logo.png" alt=""></a>
            </div>
            <div class="pull-right">
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-cancel"></span></div>
        <nav class="menu-box">
            <div class="nav-logo"><a href="/"><img src="images/logo.png" alt="" title=""></a></div>
            <div class="menu-outer"></div>
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
    </div>
</header>
