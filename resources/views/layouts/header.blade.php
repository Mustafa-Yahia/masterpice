<header class="main-header">
    <div class="header-upper">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <!-- Logo -->
                <div class="logo-box">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="LoveUs - Charity and Fundraising HTML Template">
                        </a>
                    </div>
                </div>

                <!-- Nav Box -->
                <div class="nav-outer clearfix">
                    <!-- Mobile Navigation Toggler -->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                    <!-- Auth Links -->
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
                                <span class="btn-title">تسجيل الدخول</span>
                            </a>
                            <a href="{{ route('register') }}" class="theme-btn btn-style-one" style="font-size: 12px; margin: 1px;">
                                <span class="btn-title">إنشاء حساب</span>
                            </a>
                        @endauth
                    </div>

                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="{{ url('/') }}">الرئيسية</a></li>
                                <li><a href="{{ route('donation') }}">تبرع</a></li>
                                <li><a href="{{ route('volunteer.form') }}">التطوع</a></li>
                                <li class="dropdown"><a href="#">الإعلام</a>
                                    <ul>
                                        <li><a href="{{ route('gallery') }}">معرض الصور</a></li>
                                        <li><a href="{{ route('blog') }}">المدونة</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">برامجنا</a>
                                    <ul>
                                        <li><a href="{{ route('eradicate-hunger') }}">مشروع القضاء على الجوع</a></li>
                                        <li><a href="{{ route('feeding-programs') }}">برامج التغذية</a></li>
                                        <li><a href="{{ route('volunteering-programs') }}">برامج التطوع</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
