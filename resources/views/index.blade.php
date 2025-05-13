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

<style>

.chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 350px;
    max-height: 500px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 30px rgba(0,0,0,0.2);
    display: none; /* يبقى مخفيًا في البداية */
    flex-direction: column;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow: hidden;
    transform: translateY(20px);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
}

.chatbot-container.active {
    display: flex; /* يظهر كـ flex عند التنشيط */
    transform: translateY(0);
    opacity: 1;
    visibility: visible;
}
.chatbot-header {
    background: #4CAF50;
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chatbot-toggle {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

.chat-messages {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.user-message, .bot-message {
    max-width: 80%;
    padding: 10px 15px;
    border-radius: 18px;
    line-height: 1.4;
    position: relative;
}

.user-message {
    align-self: flex-end;
    background: #4CAF50;
    color: white;
    border-bottom-right-radius: 5px;
}

.bot-message {
    align-self: flex-start;
    background: #f1f1f1;
    color: #333;
    border-bottom-left-radius: 5px;
    display: flex;
    gap: 10px;
}

.avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #4CAF50;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.message-content {
    flex: 1;
}

.quick-replies {
    display: flex;
    gap: 5px;
    margin-top: 8px;
    flex-wrap: wrap;
}

.quick-replies button {
    background: rgba(255,255,255,0.2);
    border: none;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    cursor: pointer;
    transition: background 0.3s;
}

.quick-replies button:hover {
    background: rgba(255,255,255,0.3);
}

.chat-input-container {
    display: flex;
    padding: 10px;
    border-top: 1px solid #eee;
}

#user-input {
    flex: 1;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 20px;
    outline: none;
}

#send-button {
    background: #4CAF50;
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-left: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-footer {
    padding: 8px 15px;
    font-size: 11px;
    color: #777;
    text-align: center;
    border-top: 1px solid #eee;
}

.chatbot-launcher {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

/* تأثيرات للرسائل */
@keyframes messageIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.user-message, .bot-message {
    animation: messageIn 0.2s ease-out;
}

/* شريط التمرير */
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.chat-messages::-webkit-scrollbar-thumb {
    background: #4CAF50;
    border-radius: 3px;
}


    /* Read More Button */
    .read-more-btn {
        border: 2px solid #3cc88f;
        color: #3cc88f;
        font-weight: 600;
        padding: 10px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .read-more-btn:hover {
        background-color: #3cc88f;
        color: white;
        box-shadow: 0 5px 15px rgba(60, 200, 143, 0.3);
    }

    .read-more-btn .transition-all {
        transition: all 0.3s ease;
    }

    .read-more-btn:hover .transition-all {
        transform: translateX(-5px);
    }

    .view-details-btn {
        color: white;
        padding: 8px 16px;
        border: 1px solid white;
        border-radius: 50px;
        font-size: 14px;
    }
  /* View More Button */
  .view-more-btn {
        background: linear-gradient(90deg, #3cc88f 0%, #2da578 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        box-shadow: 0 5px 20px rgba(60, 200, 143, 0.3);
        transition: all 0.3s ease;
    }

    .view-more-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(60, 200, 143, 0.4);
        color: white;
    }

    .view-more-btn i {
        transition: transform 0.3s ease;
    }

    .view-more-btn:hover i {
        transform: translateX(-5px);
    }

      /* About Section Styles */
      .about-section {
        position: relative;
        padding: 80px 0;
        background-color: #f9f9f9;
    }

    .circle-one, .circle-two {
        position: absolute;
        border-radius: 50%;
        background: rgba(60, 200, 143, 0.1);
    }

    .circle-one {
        width: 200px;
        height: 200px;
        top: 10%;
        left: 5%;
    }

    .circle-two {
        width: 150px;
        height: 150px;
        bottom: 15%;
        right: 8%;
    }

   /* ===== Images Grid Layout ===== */
.images-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}
.images-grid .image {
    margin: 0;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.images-grid img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.images-grid .image:hover img {
    transform: scale(1.05);
}

/* ===== Text Block Cards ===== */
.text-block-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    height: 100%;
    text-align: center;
    transition: transform 0.3s ease;
}
.text-block-card:hover {
    transform: translateY(-10px);
}
.icon-box {
    width: 70px;
    height: 70px;
    margin: 0 auto;
    background: rgba(60, 200, 143, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.icon-box i {
    font-size: 30px;
    color: #3cc88f;
}
.text-block-card h3 {
    color: #333;
    font-weight: 700;
    font-size: 22px;
}
.text-block-card p {
    color: #666;
    font-size: 16px;
    line-height: 1.6;
}

/* ===== Cause Cards ===== */
.cause-card {
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    background: white;
    overflow: hidden;
    position: relative;
    z-index: 1;
}
.cause-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
}

/* ===== Image Container ===== */
.cause-image-link,
.cause-image-container {
    position: relative;
    height: 230px;
    overflow: hidden;
    display: block;
    width: 100%;
}
.cause-image {
    height: 100%;
    width: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.cause-card:hover .cause-image {
    transform: scale(1.08);
}

/* ===== Image Overlay ===== */
.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cause-card:hover .image-overlay {
    opacity: 1;
}

/* ===== Category Label ===== */
.category-label {
    position: absolute;
    bottom: 15px;
    left: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
}

/* ===== Card Content ===== */
.card-body {
    padding: 25px;
}
.card-title {
    text-align: center;
    font-family: 'Cairo', sans-serif;
    font-weight: 700;
    color: #2a2a2a;
    font-size: 1.3rem;
    margin-bottom: 12px;
}
.card-text {
    color: #555;
    font-size: 14px;
    line-height: 1.6;
}
.cause-meta {
    font-size: 13px;
    color: #666;
}
.cause-meta i {
    margin-left: 5px;
}

/* ===== Progress Bar Animation ===== */
.progress-animate {
    transition: width 1.5s ease-in-out;
}

/* ===== Section Base Styles ===== */
.causes-section-two {
    background-color: #f8f9fc;
    position: relative;
    overflow: hidden;
}

/* ===== Background Patterns ===== */
.bg-pattern {
    position: absolute;
    background-size: contain;
    background-repeat: no-repeat;
    opacity: 0.05;
    z-index: 0;
}
.pattern-1 {
    width: 300px;
    height: 300px;
    top: -50px;
    left: -50px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%233cc88f' d='M50 0 L100 50 L50 100 L0 50 Z'/%3E%3C/svg%3E");
}
.pattern-2 {
    width: 200px;
    height: 200px;
    bottom: 20px;
    right: -30px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle fill='%233cc88f' cx='50' cy='50' r='50'/%3E%3C/svg%3E");
}
.pattern-3 {
    width: 150px;
    height: 150px;
    top: 30%;
    right: 10%;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%233cc88f' d='M50 0 L100 100 L0 100 Z'/%3E%3C/svg%3E");
}

/* ===== Section Header ===== */
.sec-title.centered {
    position: relative;
    z-index: 1;
}
.title-badge {
    display: inline-block;
    background: linear-gradient(90deg, #3cc88f 0%, #2da578 100%);
    color: white;
    padding: 6px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px rgba(60, 200, 143, 0.3);
}
.sec-title h2 {
    font-family: 'Cairo', sans-serif;
    font-weight: 700;
    color: #2a2a2a;
    margin-bottom: 15px;
    position: relative;
    font-size: 2.2rem;
}
.sec-title .text {
    font-family: 'Cairo', sans-serif;
    font-size: 1.1rem;
    color: #555;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
}

/* ===== View More Button ===== */
.view-more-btn {
    background: linear-gradient(90deg, #3cc88f 0%, #2da578 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    box-shadow: 0 5px 20px rgba(60, 200, 143, 0.3);
    transition: all 0.3s ease;
}
.view-more-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(60, 200, 143, 0.4);
    color: white;
}
.view-more-btn i {
    transition: transform 0.3s ease;
}
.view-more-btn:hover i {
    transform: translateX(-5px);
}

/* ===== Urgent Badge ===== */
.urgent-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 2;
}
.pulse-animation {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
    }
}

/* ===== Responsive ===== */
@media (max-width: 991px) {
    .sec-title h2 {
        font-size: 1.8rem;
    }
    .cause-image-container {
        height: 200px;
    }
}
@media (max-width: 767px) {
    .sec-title h2 {
        font-size: 1.6rem;
    }
    .sec-title .text {
        font-size: 1rem;
    }
    .card-title {
        font-size: 1.1rem;
    }
}

</style>


<script>
let isChatOpen = false;
let currentSessionId = 'session-' + Math.random().toString(36).substr(2, 9);

// فتح/إغلاق الشات
document.getElementById('chatbot-launcher').addEventListener('click', toggleChat);
document.getElementById('chatbot-toggle').addEventListener('click', toggleChat);

function toggleChat() {
    isChatOpen = !isChatOpen;
    const chatbot = document.getElementById('chatbot-container');
    chatbot.classList.toggle('active');
    if (isChatOpen) {
        document.getElementById('user-input').focus();
    }
}

// إرسال الرسائل بالضغط على Enter
function handleKeyPress(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
}

// إرسال رسالة
function sendMessage() {
    const input = document.getElementById('user-input');
    const message = input.value.trim();

    if (!message) return;

    addMessage(message, 'user');
    input.value = '';

    // إظهار مؤشر تحميل
    const loadingMsg = addMessage('جاري المعالجة...', 'bot');

    // هنا يجب استبدال هذا الجزء بالاتصال الفعلي بالخادم
    setTimeout(() => {
        // إزالة رسالة التحميل
        loadingMsg.remove();

        // رد افتراضي للاختبار
        const replies = {
            "كيف أتبرع؟": "يمكنك التبرع عبر موقعنا الإلكتروني أو عن طريق الحوالة البنكية. هل تفضل طريقة معينة؟",
            "ما هي مشاريعكم الحالية؟": "نحن نركز حالياً على مشروع إفطار الصائم ومشروع كسوة العيد. هل تريد المزيد من التفاصيل؟",
            "ما الحد الأدنى للتبرع؟": "الحد الأدنى للتبرع هو 10 دينار، ولكن يمكنك التبرع بأي مبلغ ترغب به."
        };

        const reply = replies[message] || "شكراً لسؤالك. سأحاول مساعدتك في أقرب وقت ممكن.";
        addMessage(reply, 'bot');

        // إضافة أزرار سريعة
        if (message.includes("تبرع")) {
            addQuickReplies([
                'التبرع بـ 10 دينار',
                'التبرع بـ 50 دينار',
                'التبرع بمبلغ آخر'
            ]);
        }
    }, 1500);
}

// إضافة رسالة جديدة
function addMessage(text, sender) {
    const messagesContainer = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `${sender}-message`;

    if (sender === 'bot') {
        messageDiv.innerHTML = `
            <div class="bot-message">
                <div class="avatar">🤖</div>
                <div class="message-content">${text}</div>
            </div>
        `;
    } else {
        messageDiv.innerHTML = `
            <div class="user-message">${text}</div>
        `;
    }

    messagesContainer.appendChild(messageDiv);
    scrollToBottom();
    return messageDiv;
}

// إضافة أزرار رد سريع
function addQuickReplies(replies) {
    const container = document.createElement('div');
    container.className = 'quick-replies';

    replies.forEach(reply => {
        const btn = document.createElement('button');
        btn.textContent = reply;
        btn.onclick = () => {
            document.getElementById('user-input').value = reply;
            sendMessage();
        };
        container.appendChild(btn);
    });

    document.getElementById('chat-messages').appendChild(container);
    scrollToBottom();
}

// التمرير للأسفل
function scrollToBottom() {
    const messages = document.getElementById('chat-messages');
    messages.scrollTop = messages.scrollHeight;
}
</script>


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

