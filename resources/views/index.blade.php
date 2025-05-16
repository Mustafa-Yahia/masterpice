@extends('layouts.app')

@section('content')

<!-- Banner Section -->
<section class="banner-section">
    <div class="banner-carousel love-carousel owl-theme owl-carousel"
        data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items": "1" }}}'>
        <!-- Slide Item -->
        <div class="slide-item">
            <div class="image-layer lazy-image" style="background-image: url('{{ asset('storage/main-slider/BackgroundSider.png') }}');"></div>

            <div class="auto-container">
                <div class="content-box text-center">
                    <h2>ساهم في إسعاد المحتاجين <br> واجعل عطاؤك نورًا لحياتهم</h2>
                    <div class="text" >
                        تبرعك اليوم يمكن أن يكون السبب في إطعام جائع، إسعاد طفل، أو إنقاذ مريض.
                        لا تنتظر، فكل لحظة تحمل فرصة لصنع فرق حقيقي في حياة الآخرين.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-section style-two alternate">
    <div class="circle-one"></div>
    <div class="circle-two"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Right Column - Images -->
            <div class="right-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner">
                    <div class="images-grid clearfix">
                        <figure class="image wow fadeInRight" data-wow-delay="0ms">
                            <img class="lazy-image"
                                 src="{{ asset('storage/main-slider/PeopleFood.jpg') }}"
                                 alt="مساعدة المحتاجين بالطعام"
                                 loading="lazy">
                        </figure>
                        <figure class="image wow fadeInRight" data-wow-delay="300ms">
                            <img class="lazy-image"
                                 src="{{ asset('storage/main-slider/peoplehelp22.jpg') }}"
                                 alt="توزيع المساعدات الإنسانية"
                                 loading="lazy">
                        </figure>
                        <figure class="image wow fadeInRight" data-wow-delay="600ms">
                            <img class="lazy-image"
                                 src="{{ asset('storage/main-slider/peoplehelp12.jpg') }}"
                                 alt="دعم الأسر المحتاجة"
                                 loading="lazy">
                        </figure>
                        <figure class="image wow fadeInRight" data-wow-delay="900ms">
                            <img class="lazy-image"
                                 src="{{ asset('storage/main-slider/Background11.jpg') }}"
                                 alt="أنشطتنا الخيرية"
                                 loading="lazy">
                        </figure>
                    </div>
                </div>
            </div>

            <!-- Left Column - Content -->
            <div class="left-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner pr-4">
                    <div class="sec-title">
                        <h2 class="mb-4">كن جزءاً من التغيير - قدم يد المساعدة</h2>
                        <div class="text text-right" style="line-height: 1.8;">
                 يهدف الموقع إلى توفير منصة مبتكرة لجمع التبرعات لدعم الجمعية الخيرية التي تعمل على مساعدة الفقراء في المملكة الأردنية الهاشمية. من خلال هذا الموقع، يتم تأمين احتياجات الأسر المحتاجة وتقديم الدعم اللازم لتحسين حياتهم. كما يقدم الموقع فرصًا واسعة للمشاركة في حملات تطوعية تسهم في خدمة المجتمع والمساهمة في تحسين ظروف حياة الناس                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Text Blocks Section -->
        <div class="text-blocks mt-5 pt-4">
            <div class="row g-4">
                <!-- Mission Block -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="text-block-card">
                        <div class="icon-box">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="mt-3">مهمتنا</h3>
                        <p class="mt-2">
                            نهدف لتحسين حياة الأشخاص المحتاجين من خلال دعم مشاريع إنسانية
                            في التعليم والصحة والمجتمع.
                        </p>
                    </div>
                </div>

                <!-- Vision Block -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="text-block-card">
                        <div class="icon-box">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="mt-3">رؤيتنا</h3>
                        <p class="mt-2">
                            أن نكون الجسر بين الخير والمحتاجين عبر منصة موثوقة وشفافة.
                        </p>
                    </div>
                </div>

                <!-- Values Block -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="text-block-card">
                        <div class="icon-box">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="mt-3">قيمنا</h3>
                        <p class="mt-2">
                            نؤمن بالشفافية والإنسانية والجودة في تنفيذ جميع مشاريعنا الخيرية.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="chatbot-container" class="chatbot-container">
    <div class="chatbot-header">
        <h3>مساعد الجمعية الخيرية</h3>
        <button id="chatbot-toggle" class="chatbot-toggle">×</button>
    </div>

    <div id="chat-messages" class="chat-messages">
        <div class="bot-message">
            <div class="avatar">🤖</div>
            <div class="message-content">
                مرحبًا بكم في منصة عون الخيرية! كيف يمكنني مساعدتكم اليوم؟
                <div class="quick-replies">
                    <button onclick="sendQuickReply('كيف أتبرع؟')">كيف أتبرع؟</button>
                    <button onclick="sendQuickReply('ما هي مشاريعكم الحالية؟')">المشاريع الحالية</button>
                    <button onclick="sendQuickReply('ما الحد الأدنى للتبرع؟')">الحد الأدنى</button>
                </div>
            </div>
        </div>
    </div>

    <div class="chat-input-container">
        <input type="text" id="user-input" placeholder="اكتب رسالتك هنا..." autocomplete="off" onkeypress="handleKeyPress(event)">
        <button id="send-button" onclick="sendMessage()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" y1="2" x2="11" y2="13"></line>
                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
        </button>
    </div>

    <div class="chatbot-footer">
        <small>خدمة العملاء الآلية - الجمعية الخيرية</small>
    </div>
</div>

<button id="chatbot-launcher" class="chatbot-launcher">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff" stroke="#fff" stroke-width="2">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
    </svg>
</button>



<section class="causes-section-two py-5">
    <div class="auto-container">
        <div class="sec-title centered mb-5">
            <h2 style="font-family: 'Cairo', sans-serif; font-weight: 600; text-align:center">كن سببًا في تغيير حياة الآخرين</h2>
            <div class="text" style="font-family: 'Cairo', sans-serif; font-size: 16px; line-height: 1.5;">تبرعك اليوم يمكن أن يصنع فرقًا كبيرًا في حياة محتاج، لا تتردد في أن تكون سببًا في الأمل.</div>
        </div>

        <div id="causes-list" class="row gy-4">
            @forelse($causes->take(6) as $cause)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden d-flex flex-column cause-card">
                        <!-- Badge for urgent causes -->
                        @if($cause->is_urgent)
                        <div class="urgent-badge">
                            <span class="badge bg-danger py-2 px-3 rounded-pill pulse-animation">
                                <i class="fas fa-exclamation-circle me-1"></i> حملة عاجلة
                            </span>
                        </div>
                        @endif

                        <a href="{{ route('cause.show', $cause->id) }}" class="cause-image-link">
                            <img class="card-img-top cause-image" src="{{ asset('storage/' . $cause->image) }}" alt="{{ $cause->title }}" loading="lazy">
                            <div class="image-overlay">
                                <span class="view-details-btn">عرض التفاصيل</span>
                            </div>
                        </a>
                        <!-- Content -->
                        <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h5 class="card-title text-primary">{{ $cause->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($cause->description, 100) }}</p>

                                <div class="d-flex justify-content-between mt-3 small text-secondary">
                                    <span><i class="fa fa-tag me-1"></i> {{ $cause->category }}</span>
                                    <span><i class="fa fa-map-marker-alt me-1"></i> {{ $cause->location }}</span>
                                </div>

                                <!-- Progress with animation -->
                                <div class="mt-3 progress-container">
                                    @php
                                        $percentage = $cause->goal_amount > 0
                                            ? ($cause->raised_amount / $cause->goal_amount) * 100
                                            : 0;
                                    @endphp

                                    <div class="progress position-relative" style="height: 20px; background-color:#cbcbcb;">
                                        <div class="progress-bar bg-success progress-animate"
                                             role="progressbar"
                                             style="width: 0;"
                                             data-percentage="{{ $percentage }}"
                                             aria-valuenow="{{ $cause->raised_amount }}"
                                             aria-valuemin="0"
                                             aria-valuemax="{{ $cause->goal_amount }}">
                                            {{ convertToArabic(number_format($percentage, 0)) }}%
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-2 small">
                                        <span><strong>تم جمع:</strong> {{ convertToArabic(number_format($cause->raised_amount)) }} د.أ</span>
                                        <span><strong>الهدف:</strong> {{ convertToArabic(number_format($cause->goal_amount)) }} د.أ</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Button with hover effect -->
                            <div class="mt-4 mt-auto">
                                <a href="{{ route('cause.show', $cause->id) }}"
                                   class="btn w-100 rounded-pill read-more-btn">
                                    اقرأ المزيد
                                    <i class="fas fa-arrow-left ms-2 transition-all"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-heart-broken fa-3x text-muted mb-4"></i>
                        <h4 class="text-secondary" style="text-align: center">لا توجد حملات متاحة حالياً</h4>
                        <p class="text-muted" style="text-align: center">سنقوم بإضافة حملات جديدة قريباً، تفضل بزيارتنا لاحقاً</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- View More Button - Only show if there are causes -->
        @if($causes->count() > 0)
            <div class="text-center mt-5">
                <a href="{{ route('cause.index') }}" class="btn btn-primary rounded-pill view-more-btn">
                    عرض المزيد من الحملات
                    <i class="fas fa-arrow-left ms-2"></i>
                </a>
            </div>
        @endif
    </div>
</section>


<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars on scroll
        const progressBars = document.querySelectorAll('.progress-animate');

        const animateProgressBars = () => {
            progressBars.forEach(bar => {
                const percentage = bar.getAttribute('data-percentage');
                bar.style.width = percentage + '%';
            });
        };

        // Intersection Observer for progress bars
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateProgressBars();
                    observer.unobserve(entry.target);
                }
            });
        }, {threshold: 0.1});

        progressBars.forEach(bar => {
            observer.observe(bar.closest('.progress-container'));
        });

        // Add hover effect to cards
        const cards = document.querySelectorAll('.cause-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hover');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hover');
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bar-inner').forEach(function(bar) {
            const percent = bar.getAttribute('data-percent');
            bar.style.width = percent;
        });
    });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection

