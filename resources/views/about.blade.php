@extends('layouts.app')

@section('content')

{{-- <!-- Hero Section -->
<section class="about-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content pe-lg-5">
                    <h1 class="hero-title mb-4">جمعية عون الخيرية</h1>
                    <p class="hero-subtitle mb-4">نحو مجتمع متكافل ومستدام في الأردن</p>
                    <div class="hero-stats d-flex flex-wrap gap-4 mb-5">
                        <div class="stat-item">
                            <div class="stat-number" data-count="15">0</div>
                            <div class="stat-label">سنة من العطاء</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-count="120">0</div>
                            <div class="stat-label">مشروع خيري</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-count="5000">0</div>
                            <div class="stat-label">متطوع</div>
                        </div>
                    </div>
                    <div class="hero-cta">
                        <a href="#mission" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-bullseye me-2"></i> رسالتنا
                        </a>
                        <a href="#volunteer" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-hands-helping me-2"></i> كن متطوعاً
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-container">
                    <img src="{{ asset('images/about-hero.jpg') }}" alt="جمعية عون الخيرية" class="img-fluid rounded-4 shadow-lg">
                    <div class="floating-badge bg-primary">
                        <i class="fas fa-certificate"></i>
                        <span>مسجلة رسمياً لدى وزارة التنمية الاجتماعية</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- <!-- Mission Section -->
<section id="mission" class="mission-section py-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6">
                <h2 class="section-title mb-3">رسالتنا ورؤيتنا</h2>
                <p class="section-subtitle text-muted">نسعى لتحقيق التكافل الاجتماعي وتمكين الفئات المحتاجة</p>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-lg-4">
                <div class="mission-card h-100">
                    <div class="mission-icon bg-soft-primary">
                        <i class="fas fa-eye text-primary"></i>
                    </div>
                    <h3 class="mission-title">رؤيتنا</h3>
                    <p class="mission-text">مجتمع أردني متكافل يعيش فيه الجميع بكرامة وأمان، حيث يتم تمكين الفئات المحتاجة وتحقيق التنمية المستدامة.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="mission-card h-100">
                    <div class="mission-icon bg-soft-success">
                        <i class="fas fa-bullseye text-success"></i>
                    </div>
                    <h3 class="mission-title">رسالتنا</h3>
                    <p class="mission-text">تقديم المساعدات الإنسانية والعمل على تمكين المجتمع من خلال برامج تنموية مستدامة تعتمد على التطوع والتبرعات.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="mission-card h-100">
                    <div class="mission-icon bg-soft-info">
                        <i class="fas fa-chart-line text-info"></i>
                    </div>
                    <h3 class="mission-title">أهدافنا</h3>
                    <p class="mission-text">1. تخفيف معاناة الفقراء<br>2. تمكين الأسر المنتجة<br>3. دعم التعليم<br>4. تقديم الرعاية الصحية</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- History Timeline -->
<section class="timeline-section bg-light py-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6">
                <h2 class="section-title mb-3">مسيرتنا عبر السنوات</h2>
                <p class="section-subtitle text-muted" style="text-align: center">رحلة العطاء والإنجازات منذ تأسيس الجمعية</p>
            </div>
        </div>

        <div class="timeline-wrapper">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">2023</div>
                    <div class="timeline-content">
                        <h4>توسعة برامج التمكين الاقتصادي</h4>
                        <p>إطلاق 10 مشاريع صغيرة للأسر المنتجة بتمويل يصل إلى 500 ألف دينار.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-date">2020</div>
                    <div class="timeline-content">
                        <h4>جائزة التميز في العمل الخيري</h4>
                        <p>فوز الجمعية بجائزة الملك عبدالله الثاني للتميز في العمل الخيري.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-date">2017</div>
                    <div class="timeline-content">
                        <h4>برنامج كفالة الأيتام</h4>
                        <p>بدء برنامج كفالة الأيتام الذي يخدم أكثر من 300 طفل سنوياً.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-date">2015</div>
                    <div class="timeline-content">
                        <h4>إنشاء مركز الجمعية</h4>
                        <p>افتتاح المقر الرئيسي للجمعية في العاصمة عمان.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-date">2010</div>
                    <div class="timeline-content">
                        <h4>التأسيس</h4>
                        <p>تأسيس جمعية عون الخيرية بترخيص من وزارة التنمية الاجتماعية.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section py-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6">
                <h2 class="section-title mb-3">فريق القيادة</h2>
                <p class="section-subtitle text-muted">الطاقم الإداري الذي يقود جهود الجمعية</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('images/team/team-1.jpg') }}" class="img-fluid" alt="د. محمد الخالد">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="team-name">د. محمد الخالد</h4>
                        <p class="team-position">رئيس مجلس الإدارة</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('images/team/team-2.jpg') }}" class="img-fluid" alt="أ. سارة أحمد">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="team-name">أ. سارة أحمد</h4>
                        <p class="team-position">نائب الرئيس</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('images/team/team-3.jpg') }}" class="img-fluid" alt="م. خالد الزعبي">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="team-name">م. خالد الزعبي</h4>
                        <p class="team-position">أمين الصندوق</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('images/team/team-4.jpg') }}" class="img-fluid" alt="أ. ليان عبدالله">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="team-name">أ. ليان عبدالله</h4>
                        <p class="team-position">مدير البرامج</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="partners-section bg-light py-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6">
                <h2 class="section-title mb-3">شركاؤنا في العطاء</h2>
                <p class="section-subtitle text-muted">نعمل معاً لتحقيق أهداف التنمية المستدامة</p>
            </div>
        </div>

        <div class="partners-slider">
            <div class="partner-item">
                <img src="{{ asset('images/partners/moh.png') }}" alt="وزارة الصحة" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('images/partners/mosd.png') }}" alt="وزارة التنمية الاجتماعية" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('images/partners/unicef.png') }}" alt="اليونيسف" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('images/partners/undp.png') }}" alt="برنامج الأمم المتحدة الإنمائي" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('images/partners/arab-bank.png') }}" alt="البنك العربي" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('images/partners/rotana.png') }}" alt="مجموعة روتانا" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Volunteer Section -->
<section id="volunteer" class="volunteer-section py-7">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="volunteer-image">
                    <img src="{{ asset('images/volunteer.jpg') }}" alt="التطوع معنا" class="img-fluid rounded-4 shadow">
                    <div class="volunteer-badge bg-warning">
                        <i class="fas fa-users"></i>
                        <span>+5000 متطوع</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="volunteer-content ps-lg-5">
                    <h2 class="section-title mb-4">انضم إلى فريقنا التطوعي</h2>
                    <p class="mb-4">ساهم في إحداث فرق حقيقي في حياة المحتاجين وانضم إلى عائلة متطوعي جمعية عون الخيرية.</p>

                    <div class="volunteer-benefits mb-5">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="benefit-text">فرصة لتطوير مهاراتك وقدراتك</div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="benefit-text">شهادات تقديرية معتمدة</div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="benefit-text">تأمين صحي للمتطوعين الدائمين</div>
                        </div>
                    </div>

                    {{-- <a href="{{ route('volunteer.register') }}" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-user-plus me-2"></i> سجل كمتطوع
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section bg-dark text-white py-7">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="stat-number mb-2" data-count="25">0</h3>
                    <p class="stat-label">مليون دينار</p>
                    <p class="stat-desc">قيمة المساعدات المقدمة</p>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stat-number mb-2" data-count="120">0</h3>
                    <p class="stat-label">ألف مستفيد</p>
                    <p class="stat-desc">من برامج الجمعية</p>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="stat-number mb-2" data-count="350">0</h3>
                    <p class="stat-label">أسرة</p>
                    <p class="stat-desc">تم توطينها في مساكن لائقة</p>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="stat-number mb-2" data-count="5000">0</h3>
                    <p class="stat-label">طالب</p>
                    <p class="stat-desc">تم دعم تعليمهم</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6">
                <h2 class="section-title mb-3">كلمات عن الجمعية</h2>
                <p class="section-subtitle text-muted">آراء بعض المستفيدين والشركاء</p>
            </div>
        </div>

        <div class="testimonials-slider">
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <div class="testimonial-text">
                        <p>"بفضل دعم جمعية عون، تمكنت من افتتاح مشروعي الصغير الذي غير حياة أسرتي بالكامل. لم يقدموا لي المال فقط، بل ساعدوني في التخطيط والمتابعة."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-img">
                            <img src="{{ asset('images/testimonials/testimonial-1.jpg') }}" alt="أحمد السعيد">
                        </div>
                        <div class="author-info">
                            <h5>أحمد السعيد</h5>
                            <p>مستفيد من برنامج التمكين الاقتصادي</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-item">
                <div class="testimonial-content">
                    <div class="testimonial-text">
                        <p>"نفتخر بشراكتنا مع جمعية عون التي أثبتت كفاءة عالية في تنفيذ المشاريع التنموية. تعاملهم المهني وشفافيتهم جعلت التعاون معهم تجربة مميزة."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-img">
                            <img src="{{ asset('images/testimonials/testimonial-2.jpg') }}" alt="د. سمر النجار">
                        </div>
                        <div class="author-info">
                            <h5>د. سمر النجار</h5>
                            <p>مديرة البرامج في اليونيسف - الأردن</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-item">
                <div class="testimonial-content">
                    <div class="testimonial-text">
                        <p>"التطوع مع جمعية عون كان من أفضل التجارب في حياتي. تعلمت الكثير وساعدت في إحداث فرق حقيقي في حياة الناس. الفريق محترف والجو أسري."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-img">
                            <img src="{{ asset('images/testimonials/testimonial-3.jpg') }}" alt="رنا محمد">
                        </div>
                        <div class="author-info">
                            <h5>رنا محمد</h5>
                            <p>متطوعة منذ 3 سنوات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="contact-cta-section bg-primary text-white py-6">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h3 class="cta-title mb-3">هل لديك استفسار أو ترغب في التعاون معنا؟</h3>
                <p class="cta-text mb-0">فريقنا متاح للإجابة على جميع استفساراتك من الساعة 8 صباحاً حتى 5 مساءً من الأحد إلى الخميس.</p>
            </div>
            {{-- <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">
                    <i class="fas fa-envelope me-2"></i> اتصل بنا
                </a>
            </div> --}}
        </div>
    </div>
</section>

<style>
    /* Global Styles */
    :root {
        --primary-color: #2c786c;
        --secondary-color: #3cc88f;
        --dark-color: #1a1a1a;
        --light-color: #f8f9fa;
        --text-color: #333;
        --text-muted: #6c757d;
    }

    body {
        font-family: 'Tajawal', sans-serif;
        color: var(--text-color);
    }

    .section-title {
        font-weight: 700;
        color: var(--dark-color);
        position: relative;
        display: inline-block;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        right: 0;
        width: 50px;
        height: 3px;
        background: var(--secondary-color);
    }

    .section-subtitle {
        font-size: 1.1rem;
    }

    /* Hero Section */
    .about-hero-section {
        padding: 100px 0;
        background-color: #f8f9fa;
        position: relative;
        overflow: hidden;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        color: var(--dark-color);
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    .hero-stats {
        margin: 2rem 0;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        border-radius: 10px;
        background-color: rgba(60, 200, 143, 0.1);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .hero-image-container {
        position: relative;
    }

    .floating-badge {
        position: absolute;
        top: -15px;
        right: -15px;
        padding: 10px 15px;
        border-radius: 50px;
        color: white;
        font-size: 0.9rem;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Mission Section */
    .mission-section {
        background-color: white;
    }

    .mission-card {
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .mission-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .mission-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .mission-title {
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark-color);
    }

    .mission-text {
        color: var(--text-muted);
        line-height: 1.8;
    }

    .bg-soft-primary {
        background-color: rgba(44, 120, 108, 0.1);
    }

    .bg-soft-success {
        background-color: rgba(60, 200, 143, 0.1);
    }

    .bg-soft-info {
        background-color: rgba(23, 162, 184, 0.1);
    }

    /* Timeline Section */
    .timeline {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 0;
    }

    .timeline::after {
        content: '';
        position: absolute;
        width: 6px;
        background-color: var(--secondary-color);
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -3px;
        border-radius: 10px;
    }

    .timeline-item {
        padding: 10px 40px;
        position: relative;
        width: 50%;
        box-sizing: border-box;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        background-color: white;
        border: 4px solid var(--secondary-color);
        top: 15px;
        border-radius: 50%;
        z-index: 1;
    }

    .timeline-item:nth-child(odd) {
        left: 0;
    }

    .timeline-item:nth-child(even) {
        left: 50%;
    }

    .timeline-item:nth-child(odd)::after {
        right: -12px;
    }

    .timeline-item:nth-child(even)::after {
        left: -12px;
    }

    .timeline-content {
        padding: 20px 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .timeline-date {
        position: absolute;
        top: 15px;
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    .timeline-item:nth-child(odd) .timeline-date {
        right: -80px;
    }

    .timeline-item:nth-child(even) .timeline-date {
        left: -80px;
    }

    .timeline-content h4 {
        margin-top: 0;
        color: var(--primary-color);
    }

    .timeline-content p {
        margin-bottom: 0;
        color: var(--text-muted);
    }

    /* Team Section */
    .team-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-10px);
    }

    .team-img {
        position: relative;
        overflow: hidden;
    }

    .team-img img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .team-card:hover .team-img img {
        transform: scale(1.1);
    }

    .social-links {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        padding: 10px;
        background: rgba(44, 120, 108, 0.8);
        transition: bottom 0.3s ease;
    }

    .team-card:hover .social-links {
        bottom: 0;
    }

    .social-links a {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: white;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background: var(--secondary-color);
        color: white;
    }

    .team-info {
        padding: 20px;
        text-align: center;
    }

    .team-name {
        font-weight: 700;
        margin-bottom: 5px;
        color: var(--dark-color);
    }

    .team-position {
        color: var(--secondary-color);
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Partners Section */
    .partners-slider {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 30px;
    }

    .partner-item {
        flex: 0 0 calc(16.666% - 30px);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .partner-item:hover {
        transform: translateY(-5px);
    }

    .partner-item img {
        max-width: 100%;
        height: auto;
        filter: grayscale(100%);
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .partner-item:hover img {
        filter: grayscale(0);
        opacity: 1;
    }

    /* Volunteer Section */
    .volunteer-image {
        position: relative;
    }

    .volunteer-badge {
        position: absolute;
        bottom: -15px;
        right: -15px;
        padding: 10px 20px;
        border-radius: 50px;
        color: var(--dark-color);
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .volunteer-benefits {
        margin: 2rem 0;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .benefit-icon {
        width: 30px;
        height: 30px;
        background: var(--secondary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .benefit-text {
        margin: 0;
        color: var(--text-color);
    }

    /* Stats Section */
    .stat-card {
        padding: 2rem 1rem;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        font-size: 2rem;
        color: var(--secondary-color);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
    }

    .stat-label {
        font-size: 1.2rem;
        color: var(--secondary-color);
        font-weight: 600;
    }

    .stat-desc {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin-top: 5px;
    }

    /* Testimonials Section */
    .testimonials-slider {
        max-width: 800px;
        margin: 0 auto;
    }

    .testimonial-item {
        padding: 0 15px;
    }

    .testimonial-content {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .testimonial-content:before {
        content: '\201C';
        font-family: Georgia, serif;
        font-size: 60px;
        color: var(--secondary-color);
        opacity: 0.3;
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .testimonial-text {
        font-size: 1.1rem;
        font-style: italic;
        color: var(--text-color);
        margin-bottom: 1.5rem;
        line-height: 1.8;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .author-img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
    }

    .author-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-info h5 {
        margin-bottom: 5px;
        color: var(--dark-color);
    }

    .author-info p {
        margin: 0;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* Contact CTA Section */
    .cta-title {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .cta-text {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Buttons */
    .btn {
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: #235d54;
        border-color: #235d54;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(44, 120, 108, 0.3);
    }

    .btn-outline-light {
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: white;
    }

    /* Responsive Styles */
    @media (max-width: 1199.98px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .partner-item {
            flex: 0 0 calc(25% - 30px);
        }
    }

    @media (max-width: 991.98px) {
        .about-hero-section {
            padding: 80px 0;
        }

        .hero-title {
            font-size: 2.2rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .timeline::after {
            left: 31px;
        }

        .timeline-item {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }

        .timeline-item::after {
            left: 18px;
        }

        .timeline-item:nth-child(odd) {
            left: 0;
        }

        .timeline-item:nth-child(even) {
            left: 0;
        }

        .timeline-item:nth-child(odd) .timeline-date,
        .timeline-item:nth-child(even) .timeline-date {
            left: auto;
            right: auto;
            top: -30px;
            left: 70px;
        }

        .partner-item {
            flex: 0 0 calc(33.333% - 30px);
        }
    }

    @media (max-width: 767.98px) {
        .about-hero-section {
            padding: 60px 0;
            text-align: center;
        }

        .hero-stats {
            justify-content: center;
        }

        .hero-cta {
            justify-content: center;
        }

        .volunteer-content {
            padding-left: 0 !important;
            text-align: center;
        }

        .volunteer-benefits {
            text-align: right;
        }

        .partner-item {
            flex: 0 0 calc(50% - 30px);
        }
    }

    @media (max-width: 575.98px) {
        .hero-title {
            font-size: 1.8rem;
        }

        .stat-item {
            flex: 0 0 100%;
            margin-bottom: 15px;
        }

        .hero-cta .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .partner-item {
            flex: 0 0 100%;
        }
    }
</style>

<!-- Libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize testimonials slider
        $('.testimonials-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            rtl: true
        });

        // Initialize partners slider
        $('.partners-slider').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            rtl: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        // Counter animation
        $('.stat-number').counterUp({
            delay: 10,
            time: 2000
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = this.hash;
            var $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - 80
            }, 800, 'swing', function() {
                window.location.hash = target;
            });
        });
    });
</script>

@endsection
