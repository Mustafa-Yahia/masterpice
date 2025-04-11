@props(['news' => []])

<!-- Main Footer -->
<footer class="main-footer" style="direction: rtl; text-align: right; padding-bottom: 0;">
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix" style="margin-bottom: 20px;">

                <!-- Column -->
                <div class="column col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget logo-widget">
                        <div class="widget-content">
                            <div class="footer-logo">
                                <a href="/"><img class="lazy-image" src="{{ asset('images/footer-logo.png') }}" alt="Logo" /></a>
                            </div>
                            <div class="text" style="font-size: 14px; line-height: 1.6; color: #555; margin-top: 15px;">
                                منصة تبرع تهدف إلى دعم المحتاجين في الأردن من خلال حملات تبرعية مختلفة. مساهمتك تساهم في بناء مجتمع أفضل.
                            </div>
                            <ul class="social-links clearfix" style="margin-top: 15px;">
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                <li><a href="#"><span class="fab fa-vimeo-v"></span></a></li>
                                <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column -->
                <div class="column col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget links-widget">
                        <div class="widget-content">
                            <h3 style="font-size: 18px; color: #3cc88f; margin-bottom: 15px;">الخدمات</h3>
                            <ul style="list-style: none; padding: 0; color: #555; font-size: 14px;">
                                <li><a href="#">التبرع</a></li>
                                <li><a href="#">الرعاية</a></li>
                                <li><a href="#">جمع التبرعات</a></li>
                                <li><a href="#">التطوع</a></li>
                                <li><a href="#">الشراكة</a></li>
                                <li><a href="#">الوظائف</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column -->
                <div class="column col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget info-widget">
                        <div class="widget-content">
                            <h3 style="font-size: 18px; color: #3cc88f; margin-bottom: 15px;">جهات الاتصال</h3>
                            <ul class="contact-info" style="list-style: none; padding: 0; color: #555; font-size: 14px;">
                                <li>عمان، الأردن</li>
                                <li><a href="tel:+96212345678" style="color: #3cc88f;">+962 12 345 678</a></li>
                                <li><a href="mailto:info@platformjo.com" style="color: #3cc88f;">info@platformjo.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column -->
                <div class="column col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget news-widget">
                        <div class="widget-content">
                            <h3 style="font-size: 18px; color: #3cc88f; margin-bottom: 15px;">أهم الأخبار</h3>
                            @foreach($news as $item)
                            <div class="news-post" style="margin-bottom: 15px;">
                                <div class="post-thumb">
                                    <a href="#">
                                        <img class="lazy-image" src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
                                    </a>
                                </div>
                                <h5 style="font-size: 16px; color: #25282a; margin-top: 10px;">
                                    <a href="#">{{ $item['title'] }}</a>
                                </h5>
                                <div class="date" style="font-size: 14px; color: #777;">{{ $item['date'] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom" style="background-color: #25282A; padding: 15px 0; color: white;">
        <div class="auto-container">
            <div class="clearfix d-flex justify-content-between align-items-center flex-wrap">
                <div class="copyright" style="font-size: 14px; color: #fff;">منصة التبرع في الأردن 2025 &copy; جميع الحقوق محفوظة</div>
                <ul class="bottom-links d-flex gap-3" style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="#" style="color: #fff;">شروط الخدمة</a></li>
                    <li><a href="#" style="color: #fff;">سياسة الخصوصية</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
