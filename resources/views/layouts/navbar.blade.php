{{-- <!-- Header Top -->
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
</div> --}}
