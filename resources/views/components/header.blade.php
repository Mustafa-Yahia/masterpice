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
                            <img src="{{ asset('images/LogoAwn.png') }}" alt="Logo">
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
                                    <button class="dropdown-toggle" id="userDropdown" aria-expanded="false">
                                        <span class="text-white">مرحباً، {{ Auth::user()->name }}</span>
                                        <i class="fas fa-caret-down"></i> <!-- Arrow Icon -->
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                                        <!-- رابط إلى صفحة الملف الشخصي -->
                                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                                            <i class="fas fa-user-circle"></i> الملف الشخصي
                                        </a>

                                        <!-- نموذج تسجيل الخروج -->
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @else
                                <a href="{{ route('login') }}" class="theme-btn btn-style-one" style="font-size: 12px; margin: 1px;">
                                    <span class="btn-title"><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</span>
                                </a>
                                <a href="{{ route('register') }}" class="theme-btn btn-style-one" style="font-size: 12px; margin: 1px;">
                                    <span class="btn-title"><i class="fas fa-user-plus"></i> إنشاء حساب</span>
                                </a>
                            @endauth
                        </div>
                    </div>
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md navbar-center">
    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
        <ul class="navigation clearfix">
            <li><a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> عن الجمعية</a></li>
            {{-- <li><a href="{{ route('volunteer.form') }}" class="{{ Route::is('volunteer.form') ? 'active' : '' }}"><i class="fas fa-hands-helping"></i> التأثير والتغيير</a></li> --}}
            <li><a href="{{ route('cause.index') }}" class="{{ Route::is('cause.index') ? 'active' : '' }}"><i class="fas fa-heart"></i> تبرع</a></li>

            <li><a href="{{ route('event.index') }}" class="{{ Route::is('event.index') ? 'active' : '' }}"><i class="fas fa-hands-helping"></i> تطوع</a></li>

            <li><a href="/" class="{{ Route::is('home') ? 'active' : '' }}"><i class="fas fa-home"></i> الرئيسية</a></li>


        </ul>
    </div>
</nav>

                </div>
            </div>
        </div>
    </div>
    <!-- End Header Upper -->

    <!-- Sticky Header -->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <div class="logo pull-left">
                <a href="/"><img src="{{ asset('images/LogoAwn.png') }}" alt="" width="75px"></a>
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
            <div class="nav-logo"><a href="/"><img src="{{ asset('images/LogoAwn.png') }}" alt="" title="" width="100px"></a></div>
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

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

<!-- Dropdown Styles -->
<style>
    .dropdown {
        position: relative;
        display: inline-block;
        z-index: 9999;  /* Ensure Dropdown appears above other content */
    }

    .dropdown-toggle {
        background: #3cc88f;
        border: 1px solid #fff;
        font-size: 18px;
        font-weight: bold;
        padding: 8px 15px;
        border-radius: 8px;
        text-align: left;
        color: #fff;
        display: flex;
        align-items: center;
        cursor: pointer;
        margin-top: 10px;
    }

    .dropdown-toggle i {
        margin-left: 10px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        min-width: 150px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f8f9fa;
        top: 100%;
        left: 0;
        z-index: 9999;  /* Ensure dropdown is above other content */
    }

    .dropdown-menu li {
        list-style: none;
    }

    .dropdown-menu a,
    .dropdown-menu button {
        display: block;
        padding: 10px;
        font-size: 14px;
        color: #333;
        text-align: right;
        background: none;
        border: none;
        text-decoration: none;
    }

    .dropdown-menu a:hover,
    .dropdown-menu button:hover {
        background-color: #ddd;
    }

    .dropdown.active .dropdown-menu {
        display: block;
    }
</style>

<!-- Dropdown Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userDropdown = document.getElementById('userDropdown');

        if (userDropdown) {
            userDropdown.addEventListener('click', function (e) {
                e.stopPropagation();
                const dropdown = this.closest('.dropdown');
                dropdown.classList.toggle('active');
            });

            document.addEventListener('click', function () {
                document.querySelectorAll('.dropdown.active').forEach(function (dropdown) {
                    dropdown.classList.remove('active');
                });
            });
        }
    });
</script>

