@props(['contactInfo' => []])

<!-- Professional Footer -->
<footer class="professional-footer" dir="rtl">
    <!-- Footer Top Section -->
    <div class="footer-top-section bg-gradient-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="footer-cta-title">جاهزون لمساعدتك على مدار الساعة</h3>
                    <p class="footer-cta-text">فريق دعم العملاء متاح 24/7 للإجابة على استفساراتك</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="btn btn-light btn-lg rounded-pill" data-bs-toggle="modal" data-bs-target="#contactModal">
                        <i class="fas fa-headset me-2"></i> اتصل بنا الآن
                    </a>


                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer Content -->
    <div class="main-footer-content bg-dark">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Brand Info Column -->
                <div class="col-lg-4">
                    <div class="brand-widget text-center text-lg-start">
                        <div class="logo-container mb-4">
                            <a href="/" class="footer-logo">
                                <img class="lazy-image" src="{{ asset('images/LogoAwn.png') }}" alt="Logo" width="100px" />
                            </a>
                        </div>
                        <p class="brand-description mt-4">
                            جمعية خيرية أردنية تسعى لتقديم المساعدات الإنسانية وتمكين المجتمع المحلي من خلال برامج التبرع والتطوع المستدامة.
                        </p>
                        <div class="trust-badges mt-4 text-center text-lg-start">
                            {{-- <img src="{{ asset('images/ssl-secured.png') }}" alt="SSL Secured" width="80" class="me-2">
                            <img src="{{ asset('images/payment-verified.png') }}" alt="Payment Verified" width="80"> --}}
                         <!-- Jordanian Kingdom Logo -->
                            {{-- <img src="{{ asset('images/jordan-kingdom-logo.png') }}" alt="Jordanian Kingdom Logo" width="80" class="mt-3"> --}}
                            <img src="{{ asset('images/wst.png') }}" alt="Jordanian Kingdom Logo" width="400px"  class="mt-3">
                        </div>
                    </div>
                </div>

                <!-- Quick Links Column -->
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">روابط سريعة</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('index') }}">الرئبسية</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">عن الجمعية</a>
                            </li>                            <li><a href="">مشاريعنا</a></li>
                            <li><a href="{{ route('event.index') }}">التطوع</a></li>
                            <li><a href="">المدونة</a></li>
                            {{-- <li><a href="">اتصل بنا</a></li> --}}
                        </ul>
                    </div>
                </div>

                <!-- Services Column -->
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">حملاتنا</h4>
                        <ul class="footer-links">
                            <li><a href="">أفطار صائم</a></li>
                            <li><a href="">تكافل تعليمي</a></li>
                            <li><a href="">شتاء دافئ</a></li>
                            <li><a href="">كفالة الأيتام</a></li>
                            <li><a href="">علاج المرضى</a></li>
                            {{-- <li><a href="">استضافة المواقع</a></li> --}}
                        </ul>
                    </div>
                </div>

                <!-- Contact Info Column -->
                <div class="col-lg-4 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">تواصل معنا</h4>
                        <ul class="contact-info">
                            <li class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <span>العنوان:</span>
                                    <p>عمان، المملكة الأردنية الهاشمية </p>
                                </div>
                            </li>
                            <li class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <span>الهاتف:</span>
                                    <p><a href="tel:+966112345678">+962 78 021 1175</a></p>
                                </div>
                            </li>
                            <li class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope" style="color: #3cc88f"></i>
                                </div>
                                <div class="contact-text">
                                    <span>البريد الإلكتروني:</span>
                                    <p><a href="mailto:info@example.com">mustafayahia120@example.com</a></p>
                                </div>
                            </li>
                            <li class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-text">
                                    <span>ساعات العمل:</span>
                                    <p>الأحد - الخميس: 8 صباحاً - 5 مساءً</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom Section -->
    <div class="footer-bottom bg-darker">
        <div class="container">
            <div class="footer-bottom-content">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="copyright-text">
                            <p>&copy; <span id="current-year"></span> جميع الحقوق محفوظة لشركة <a href="/">عون</a></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-extras">
                            <div class="social-linkss">
                                <a href="#" class="social-link" target="_blank" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-link" target="_blank" aria-label="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-link" target="_blank" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="social-link" target="_blank" aria-label="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="social-link" target="_blank" aria-label="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button class="back-to-top" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>


    <!-- Contact Info Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true" dir="rtl">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-end">
        <div class="modal-header">
          <h5 class="modal-title" id="contactModalLabel">معلومات الاتصال</h5>
          <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card p-3">
            <p><strong>📍 العنوان:</strong> عمان، المملكة الأردنية الهاشمية</p>
            <p><strong>📞 الهاتف:</strong> <a href="tel:+962780211175">+962 780 211 175</a></p>
            <p><strong>📧 البريد الإلكتروني:</strong> <a href="mailto:mustafayahia120@example.com">mustafayahia120@example.com</a></p>
            <p><strong>⏰ ساعات العمل:</strong> الأحد - الخميس: 8 صباحاً - 5 مساءً</p>
          </div>
        </div>
      </div>
    </div>
  </div>

</footer>

<style>

    /* Professional Footer Styles */
    .professional-footer {
        font-family: 'Tajawal', sans-serif;
        position: relative;
    }

    /* Footer Top Section */
    .footer-top-section {
        padding: 30px 0;
        background: linear-gradient(135deg, #2c3e50 0%, #3cc88f 100%);
        color: #fff;
    }

    .footer-cta-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .footer-cta-text {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Main Footer Content */
    .main-footer-content {
        background-color: #1a1a1a;
        color: #fff;
    }

    .footer-logo img {
        max-width: 180px;
        height: auto;
    }

    .brand-description {
        color: #aaa;
        line-height: 1.8;
        font-size: 0.95rem;
    }

    .trust-badges img {
        transition: transform 0.3s ease;
    }

    .trust-badges img:hover {
        transform: translateY(-5px);
    }

    /* Footer Widgets */
    .footer-widget {
        margin-bottom: 30px;
    }

    .widget-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 25px;
        padding-bottom: 15px;
        position: relative;
    }

    .widget-title::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(to right, #3cc88f, #2c3e50);
    }

    /* Footer Links */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: #aaa;
        text-decoration: none;
        transition: all 0.3s ease;
        display: block;
        padding: 5px 0;
        position: relative;
        font-size: 0.95rem;
    }

    .footer-links a::before {
        content: '';
        position: absolute;
        right: -15px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 1px;
        background-color: #3cc88f;
        transition: width 0.3s ease;
    }

    .footer-links a:hover {
        color: #fff;
        padding-right: 15px;
    }

    .footer-links a:hover::before {
        width: 10px;
    }

    /* Contact Info */
    .contact-info {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact-item {
        display: flex;
        margin-bottom: 20px;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        background-color: rgba(76, 161, 175, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
        flex-shrink: 0;
        color: #4ca1af;
    }

    .contact-text {
        flex: 1;
    }

    .contact-text span {
        display: block;
        color: #3cc88f;
        font-size: 0.85rem;
        margin-bottom: 3px;
    }

     /* Logo Container */
     .logo-container {
        display: flex;
        justify-content: center;
    }

    @media (min-width: 992px) {
        .logo-container {
            justify-content: flex-start;
        }
    }
    .contact-text p,
    .contact-text a {
        color: #aaa;
        margin: 0;
        font-size: 0.95rem;
        transition: color 0.3s ease;
    }

    .contact-text a:hover {
        color: #fff;
        text-decoration: none;
    }

    /* Footer Bottom */
    .footer-bottom {
        background-color: #111;
        padding: 20px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .copyright-text {
        color: #777;
        font-size: 0.9rem;
    }

    .copyright-text a {
        color: #3cc88f;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .copyright-text a:hover {
        color: #fff;
    }

    /* Social Links */
    .social-linkss {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }


    /*  */

    .fa-envelope:before {
    content: "\f0e0";
}

.fa-map-marker-alt:before {
    color: #3cc88f;
    content: "\f3c5";
}

.fa-phone-alt:before {
    color: #3cc88f;
    content: "\f879";
}

.fa-clock:before {
    color: #3cc88f;
    content: "\f017";
}

    .social-link {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.05);
        color: #aaa;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background-color: #3cc88f;
        color: #fff;
        transform: translateY(-3px);
    }

    /* Back to Top Button */
    .back-to-top {
        position: fixed;
        bottom: 30px;
        left: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #3cc88f;
        color: #fff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .back-to-top.active {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background-color: #2c3e50;
        transform: translateY(-3px);
    }

    /* Responsive Styles */
    @media (max-width: 991.98px) {
        .footer-cta-title {
            font-size: 1.5rem;
        }

        .footer-widget {
            margin-bottom: 40px;
        }
    }

    @media (max-width: 767.98px) {
        .footer-top-section {
            text-align: center;
        }

        .footer-top-section .btn {
            margin-top: 15px;
        }

        .widget-title::after {
            right: auto;
            left: 0;
        }

        .copyright-text,
        .social-linkss {
            justify-content: center;
            text-align: center;
        }

        .social-linkss {
            margin-top: 15px;
        }

        .back-to-top {
            width: 40px;
            height: 40px;
            bottom: 20px;
            left: 20px;
        }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Back to Top Button
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopBtn = document.querySelector('.back-to-top');

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('active');
            } else {
                backToTopBtn.classList.remove('active');
            }
        });

        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Update current year
        document.getElementById('current-year').textContent = new Date().getFullYear();
    });
</script>


