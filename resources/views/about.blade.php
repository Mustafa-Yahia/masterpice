@extends('layouts.app')

@section('content')

<section class="about-hero">
    <div class="hero-container">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="hero-text">
                            <div class="badge mb-3 animate__animated animate__fadeIn">
                                <span class="badge-text">من نحن</span>
                            </div>
                            <h1 class="hero-title animate__animated animate__fadeInDown text-white">
                                <span class="highlight">قصتنا</span> وإنجازاتنا
                            </h1>
                            <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s text-white">
                                نؤمن بقوة العمل الإنساني في تغيير المجتمعات وبناء مستقبل أفضل للجميع
                            </p>
                            <div class="hero-stats d-flex mb-4 animate__animated animate__fadeIn animate__delay-1s">
                                <div class="stat-item me-4">
                                    <div class="stat-number">+10</div>
                                    <div class="stat-label">سنوات خبرة</div>
                                </div>
                                <div class="stat-item me-4">
                                    <div class="stat-number">500+</div>
                                    <div class="stat-label">مشروع ناجح</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">1M+</div>
                                    <div class="stat-label">مستفيد</div>
                                </div>
                            </div>
                            <div class="hero-cta animate__animated animate__fadeInUp animate__delay-2s">
                                <a href="#our-story" class="btn btn-primary btn-lg me-3">
                                    <i class="fas fa-book-open me-2"></i> تعرف على قصتنا
                                </a>
                                <a href="#team" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-users me-2"></i> فريق العمل
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="hero-image-container animate__animated animate__fadeInRight animate__delay-1s">
                            <div class="hero-image">
                                <img src="{{ asset('images/background/Background-events.jpeg') }}" alt="من نحن" class="img-fluid rounded-3 shadow-lg">
                            </div>
                            <div class="floating-icons">
                                <div class="icon-1"><i class="fas fa-star"></i></div>
                                <div class="icon-2"><i class="fas fa-medal"></i></div>
                                <div class="icon-3"><i class="fas fa-trophy"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- History Timeline -->
{{-- <section class="timeline-section bg-light py-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6 mt-5">
                <h2 id="our-story" class="section-title mb-3">مسيرتنا عبر السنوات</h2>
                <p class="section-subtitle text-muted" style="text-align:center">رحلة العطاء والإنجازات منذ تأسيس الجمعية</p>
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
</section> --}}
<section class="timeline-section bg-light py-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6 mt-5">
                <h2 id="our-story" class="section-title mb-3">مسيرتنا عبر السنوات</h2>
                <p class="section-subtitle text-muted" style="text-align:center">رحلة العطاء والإنجازات منذ تأسيس الجمعية</p>
            </div>
        </div>

        <div class="timeline-wrapper">
            <div class="timeline">
                <?php
                $events = \App\Models\TimelineEvent::orderBy('year', 'desc')->get();
                ?>
                @foreach($events as $event)
                    <div class="timeline-item">
                        <div class="timeline-date">{{ $event->year }}</div>
                        <div class="timeline-content">
                            <h4>{{ $event->title }}</h4>
                            <p>{{ $event->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



<section class="team-section py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6">
                <h2 class="section-title mb-3">فريق القيادة</h2>
                <p class="section-subtitle text-muted" style="text-align: center ">الطاقم الإداري الذي يقود جهود الجمعية</p>
            </div>
        </div>

        <div  id="team" class="row g-4">
            @foreach($teams as $member)
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-img">
                      @if($member->image)
                         <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" style="width: 100%; height: 250px; object-fit:cover">
                                   @else
                                  <!-- صورة افتراضية -->
                               <img src="{{ asset('images/default-member.jpg') }}" alt="{{ $member->name }}">
                          @endif
                        <div class="social-links" style="display: flex; justify-content: center; margin-top: 10px;">
                            @if($member->twitter)
                            <a href="{{ $member->twitter }}" target="_blank" style="margin: 0 8px;"><i class="fab fa-twitter"></i></a>
                            @endif

                            @if($member->linkedin)
                            <a href="{{ $member->linkedin }}" target="_blank" style="margin: 0 8px;"><i class="fab fa-linkedin-in"></i></a>
                            @endif

                            @if($member->email)
                            <a href="mailto:{{ $member->email }}" style="margin: 0 8px;"><i class="fas fa-envelope"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="team-info mt-3">
                        <h4 class="team-name" style="text-align: center">{{ $member->name }}</h4>
                        <p class="team-position text-muted" style="text-align:center">{{ $member->position }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Team Section -->

<!-- Partners Section -->
<section class="partners-section bg-light py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-6">
                <h2 class="section-title mb-3 mt-3">شركاؤنا في العطاء</h2>
                <p class="section-subtitle text-muted" style="text-align: center">نعمل معاً لتحقيق أهداف التنمية المستدامة</p>
            </div>
        </div>

        <div class="partners-slider">
            <div class="partner-item">
                <img src="{{ asset('partners/moh.png') }}" alt="وزارة الصحة" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('partners/microsoftteams.png') }}" alt="وزارة التنمية الاجتماعية" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('partners/Logo_of_UNICEF.svg.png') }}" alt="اليونيسف" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('partners/UNDP_logo.svg.png') }}" alt="برنامج الأمم المتحدة الإنمائي" class="img-fluid">
            </div>
            <div class="partner-item">
                <img src="{{ asset('partners/ArabBankLogo.png') }}" alt="البنك العربي" class="img-fluid">
            </div>

        </div>
    </div>
</section>

<!-- Volunteer Section -->
<section id="volunteer" class="volunteer-section py-7 mt-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="volunteer-image">
                    <img src="{{ asset('images/volunteer.png') }}" alt="التطوع معنا" class="img-fluid rounded-4 shadow">
                    <div class="volunteer-badge bg-warning">
                        <i class="fas fa-users"></i>
                        <span>+5000 متطوع</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
<div class="volunteer-content ps-lg-5" style="text-align: center;">
<h2 class="section-title mb-4" style="text-align: center;">انضم إلى فريقنا التطوعي</h2>{{--  how do well titel in center --}}
                    <p class="mb-4">ساهم في إحداث فرق حقيقي في حياة المحتاجين وانضم إلى عائلة متطوعي جمعية عون الخيرية.</p>

                            <div class="volunteer-benefits mb-5" style="direction: rtl;" >

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

                    <a href="{{ route('event.index') }}" class="btn  btn-lg px-5 mb-3" style="background-color: #3cc88f; color: white;">
                        <i class="fas fa-user-plus me-2" ></i> سجل كمتطوع
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<style>
    .about-hero {
    position: relative;
    background: linear-gradient(90deg, #2da578 100%, #2da578 100%);
    color: #fff;
    padding: 120px 0 0;
    overflow: hidden;
}

.about-hero .hero-container {
    position: relative;
}

.about-hero .hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.about-hero .hero-content {
    position: relative;
    z-index: 2;
    padding-bottom: 80px;
}

.about-hero .badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    padding: 8px 20px;
    border-radius: 30px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.about-hero .badge-text {
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1px;
}

.about-hero .hero-title {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1.3;
}

.about-hero .hero-title .highlight {
    color: #ffd700;
    position: relative;
    display: inline-block;
}

.about-hero .hero-title .highlight:after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 10px;
    background: rgba(255, 255, 255, 0.3);
    z-index: -1;
    border-radius: 3px;
}

.about-hero .hero-subtitle {
    font-size: 18px;
    margin-bottom: 30px;
    max-width: 600px;
    line-height: 1.8;
    opacity: 0.9;
}

.about-hero .hero-stats {
    gap: 20px;
    flex-wrap: wrap;
}

.about-hero .stat-item {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    padding: 15px 25px;
    border-radius: 10px;
    min-width: 120px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.about-hero .stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.2);
}

/* how to  */
.about-hero .stat-number {
    font-size: 28px;
    font-weight: 700;
    line-height: 1;
    background: #ffd700;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.about-hero .stat-label {
    font-size: 14px;
    opacity: 0.9;
    margin-top: 5px;
}

.about-hero .hero-cta .btn {
    padding: 12px 25px;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.about-hero .hero-cta .btn-primary {
    background: #3cc88f;
    border-color: #3cc88f;
    box-shadow: 0 5px 15px rgba(60, 200, 143, 0.3);
}

.about-hero .hero-cta .btn-primary:hover {
    background: #2fa578;
    border-color: #2fa578;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(60, 200, 143, 0.4);
}

.about-hero .hero-cta .btn-outline-light {
    border-width: 2px;
}

.about-hero .hero-cta .btn-outline-light:hover {
    color: #FFF;
    background: #ffd700;
    transform: translateY(-3px);
}

.about-hero .hero-image-container {
    position: relative;
}

.about-hero .hero-image {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    transform: perspective(1000px) rotateY(-10deg);
    transition: all 0.5s ease;
}

.about-hero .hero-image:hover {
    transform: perspective(1000px) rotateY(0deg);
}

.about-hero .floating-icons {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.about-hero .floating-icons div {
    position: absolute;
    width: 50px;
    height: 50px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3cc88f;
    font-size: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    animation: floating 5s infinite ease-in-out;
}

.about-hero .floating-icons .icon-1 {
    top: 20%;
    left: -15px;
    animation-delay: 0s;
}

.about-hero .floating-icons .icon-2 {
    top: 60%;
    right: -20px;
    animation-delay: 1s;
}

.about-hero .floating-icons .icon-3 {
    bottom: 10%;
    left: 30%;
    animation-delay: 2s;
}

.about-hero .hero-wave {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 150px;
    z-index: 3;
}

/* Animations */
@keyframes floating {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(5deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

/* Responsive */
@media (max-width: 991px) {
    .about-hero {
        padding: 100px 0 0;
    }

    .about-hero .hero-title {
        font-size: 36px;
    }

    .about-hero .hero-stats {
        gap: 15px;
    }

    .about-hero .stat-item {
        padding: 12px 20px;
        min-width: 100px;
    }

    .about-hero .stat-number {
        font-size: 24px;
    }
}

@media (max-width: 767px) {
    .about-hero {
        padding: 80px 0 0;
        text-align: center;
    }

    .about-hero .hero-title {
        font-size: 28px;
    }

    .about-hero .hero-subtitle {
        margin-left: auto;
        margin-right: auto;
    }

    .about-hero .hero-stats {
        justify-content: center;
    }

    .about-hero .hero-cta {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .about-hero .hero-cta .btn {
        width: 100%;
        margin-right: 0 !important;
    }
}
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
        color: #fff;
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
    will-change: transform;
    backface-visibility: hidden;
    margin-bottom: 30px;
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
    will-change: transform;
    backface-visibility: hidden;
    filter: brightness(0.98);
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
    background: linear-gradient(135deg, #2c3e50 0%, #3cc88f);
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
    text-decoration: none;
    outline: none;
}

.social-links a:hover,
.social-links a:focus {
    background: var(--secondary-color);
    color: white;
}

.social-links a:focus {
    box-shadow: 0 0 0 3px rgba(44, 120, 108, 0.5);
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

@media (hover: none) {
    .team-card:hover {
        transform: none;
    }
    .team-card:hover .team-img img {
        transform: none;
    }
    .social-links {
        bottom: 0;
    }
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
        color: #fff;
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
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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
