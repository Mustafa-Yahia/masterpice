@extends('layouts.app')

@section('content')

<!-- Page Banner Section -->
<section class="modern-hero">
    <div class="hero-container">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="hero-text">
                            <div class="badge mb-3 animate__animated animate__fadeIn">
                                <span class="badge-text">فعاليات إنسانية</span>
                            </div>
                            <h1 class="hero-title animate__animated animate__fadeInDown">
                                <span class="highlight">فعالياتنا</span> الخيرية
                            </h1>
                            <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                                انضم إلى رحلتنا في إحداث تغيير إيجابي في المجتمع
                            </p>
                            <div class="hero-stats d-flex mb-4 animate__animated animate__fadeIn animate__delay-1s">
                                <div class="stat-item me-4">
                                    <div class="stat-number">+50</div>
                                    <div class="stat-label">فعالية سنوياً</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">100%</div>
                                    <div class="stat-label">تطوع خيري</div>
                                </div>
                            </div>
                            <div class="hero-cta animate__animated animate__fadeInUp animate__delay-2s">
                                <a href="#events" class="btn  btn-lg me-3" style="background: #3cc88f; color: #FFF;">
                                    <i class="fas fa-calendar-alt me-2"></i> تصفح الفعاليات
                                </a>
                                <a href="#subscribe" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-bell me-2"></i> اشترك للتنبيهات
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="hero-image-container animate__animated animate__fadeInRight animate__delay-1s">
                            <div class="hero-image">
                                <img src="{{ asset('images/background/Background-events.jpeg') }}" alt="فعاليات خيرية" class="img-fluid">
                            </div>
                            <div class="floating-icons">
                                <div class="icon-1"><i class="fas fa-hands-helping"></i></div>
                                <div class="icon-2"><i class="fas fa-heart"></i></div>
                                <div class="icon-3"><i class="fas fa-donate"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 150">
                <path fill="#fff" fill-opacity="1" d="M0,96L48,90C96,85,192,75,288,69.3C384,64,480,64,576,80C672,96,768,128,864,128C960,128,1056,96,1152,85.3C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>
</section>

{{-- <section class="volunteer-events-section py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($events as $event)
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <div class="volunteer-card h-100">
                        <div class="card-header position-relative">
                            <a href="{{ route('event.show', $event->id) }}">
                                <img class="card-img-top" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                            </a>
                            <div class="event-date-badge">
                                <span class="day">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                                <span class="month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            </div>
                            @if($event->volunteers_needed > 0)
                            <div class="volunteer-progress">
                                <div class="progress-text">
                                    المتطوعون: {{ $event->volunteer_count }}/{{ $event->volunteers_needed }}
                                </div>
                                <div class="progress">
                                    <div class="progress-bar"
                                         role="progressbar"
                                         style="width: {{ ($event->volunteer_count / $event->volunteers_needed) * 100 }}%"
                                         aria-valuenow="{{ $event->volunteer_count }}"
                                         aria-valuemin="0"
                                         aria-valuemax="{{ $event->volunteers_needed }}">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3 class="card-title" style="text-align: center" >
                                <a href="{{ route('event.show', $event->id) }}">{{ $event->title }}</a>
                            </h3>
                            <div class="event-meta d-flex flex-wrap gap-2">
                                <!-- الموقع -->
                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="fas fa-map-marker-alt ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500;">{{ $event->location }}</span>
                                </div>

                                <!-- الوقت -->
                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="far fa-clock ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500; display: flex; justify-content: flex-start; direction: ltr;">
                                        @if($event->end_time)
                                            {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($event->time)->addHours(2)->format('h:i A') }}
                                        @endif
                                        <span style="color: #3cc88f; margin: 0 3px;">←</span>
                                        {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
                                    </span>
                                </div>

                                <!-- التصنيف (إذا موجود) -->
                                @if($event->category)
                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="fas fa-tag ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500;">{{ $event->category }}</span>
                                </div>
                                @endif
                            </div>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('event.show', $event->id) }}" class="btn" style="background: #ffd700; color: white;">
                                <i class="fas fa-info-circle me-2"></i> التفاصيل
                            </a>
                            @if(auth()->check())
                                @if($event->volunteers->contains(auth()->id()))
                                    <button class="btn btn-success" disabled>
                                        <i class="fas fa-check-circle me-2"></i> مسجل بالفعل
                                    </button>
                                @elseif($event->volunteer_count < $event->volunteers_needed)
                                    <a href="{{ route('event.subscribe', $event->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-hand-holding-heart me-2"></i> سجل كمتطوع
                                    </a>
                                @else
                                    <button class="btn btn-secondary" disabled>
                                        <i class="fas fa-times-circle me-2"></i> اكتمل العدد
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-sign-in-alt me-2"></i> سجل الدخول للتطوع
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-events-state text-center py-5">
                        <div class="empty-icon mb-4">
                            <i class="fas fa-calendar-plus fa-4x text-primary"></i>
                        </div>
                        <h3 class="mb-3">لا توجد حملات تطوعية حالياً</h3>
                        <p class="text-muted mb-4">يمكنك متابعتنا لمعرفة أحدث الحملات التطوعية القادمة</p>
                        <a href="{{ route('index') }}" class="btn btn-primary px-4">
                            <i class="fas fa-home me-2"></i> العودة للرئيسية
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section> --}}

<section class="volunteer-events-section py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($events as $event)
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <div class="volunteer-card h-100">
                        <div class="card-header position-relative">
                            <a href="{{ route('event.show', $event->id) }}">
                                <img class="card-img-top" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                            </a>
                            <div class="event-date-badge">
                                <span class="day">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                                <span class="month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            </div>
                            @if($event->volunteers_needed > 0)
                            <div class="volunteer-progress">
                                <div class="progress-text">
                                    المتطوعون: {{ $event->volunteer_count }}/{{ $event->volunteers_needed }}
                                </div>
                                <div class="progress">
                                    <div class="progress-bar"
                                         role="progressbar"
                                         style="width: {{ ($event->volunteer_count / $event->volunteers_needed) * 100 }}%"
                                         aria-valuenow="{{ $event->volunteer_count }}"
                                         aria-valuemin="0"
                                         aria-valuemax="{{ $event->volunteers_needed }}">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3 class="card-title" style="text-align: center">
                                <a href="{{ route('event.show', $event->id) }}">{{ $event->title }}</a>
                            </h3>
                            <div class="event-meta d-flex flex-wrap gap-2">
                                <!-- الموقع -->
                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="fas fa-map-marker-alt ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500;">{{ $event->location }}</span>
                                </div>

                                <!-- الوقت -->
                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="far fa-clock ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500; display: flex; justify-content: flex-start; direction: ltr;">
                                        @if($event->end_time)
                                            {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($event->time)->addHours(2)->format('h:i A') }}
                                        @endif
                                        <span style="color: #3cc88f; margin: 0 3px;">←</span>
                                        {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
                                    </span>
                                </div>

                                <!-- مواعيد التسجيل -->
                                @if($event->registration_start || $event->registration_end)
                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="fas fa-user-clock ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500;">
                                        @if($event->registration_start && $event->registration_end)
                                            التسجيل: {{ $event->registration_start->format('d/m h:i A') }} - {{ $event->registration_end->format('d/m h:i A') }}
                                        @elseif($event->registration_start)
                                            يبدأ: {{ $event->registration_start->format('d/m h:i A') }}
                                        @elseif($event->registration_end)
                                            ينتهي: {{ $event->registration_end->format('d/m h:i A') }}
                                        @endif
                                    </span>
                                </div>
                                @endif

                                <!-- التصنيف (إذا موجود) -->
                                @if($event->category)
                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="fas fa-tag ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500;">{{ $event->category }}</span>
                                </div>
                                @endif
                            </div>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('event.show', $event->id) }}" class="btn" style="background: #ffd700; color: white;">
                                <i class="fas fa-info-circle me-2"></i> التفاصيل
                            </a>

                            @if(auth()->check())
                                @if($event->volunteers->contains(auth()->id()))
                                    <button class="btn btn-success" disabled>
                                        <i class="fas fa-check-circle me-2"></i> مسجل بالفعل
                                    </button>
                                @else
                                    @php
                                        $now = now();
                                        $registrationOpen = (!$event->registration_start || $now >= $event->registration_start) &&
                                                           (!$event->registration_end || $now <= $event->registration_end);
                                    @endphp

                                    @if($event->volunteer_count >= $event->volunteers_needed)
                                        <button class="btn btn-secondary" disabled>
                                            <i class="fas fa-times-circle me-2"></i> اكتمل العدد
                                        </button>
                                    @elseif(!$registrationOpen)
                                        <button class="btn btn-warning" disabled>
                                            <i class="fas fa-clock me-2"></i>
                                            @if($event->registration_start && $now < $event->registration_start)
                                                يبدأ {{ $event->registration_start->diffForHumans() }}
                                            @else
                                                انتهى التسجيل
                                            @endif
                                        </button>
                                    @else
                                        <a href="{{ route('event.subscribe', $event->id) }}" class="btn btn-outline-primary">
                                            <i class="fas fa-hand-holding-heart me-2"></i> سجل كمتطوع
                                        </a>
                                    @endif
                                @endif
                            @else
                            <a href="{{ route('login') }}" class="btn btn-outline-custom">
                                <i class="fas fa-sign-in-alt me-2"></i> سجل الدخول للتطوع
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-events-state text-center py-5">
                        <div class="empty-icon mb-4">
                            <i class="fas fa-calendar-plus fa-4x text-primary"></i>
                        </div>
                        <h3 class="mb-3">لا توجد حملات تطوعية حالياً</h3>
                        <p class="text-muted mb-4">يمكنك متابعتنا لمعرفة أحدث الحملات التطوعية القادمة</p>
                        <a href="{{ route('index') }}" class="btn  px-4" style="background: #3cc88f; color: #FFF;">
                            <i class="fas fa-home me-2"></i> العودة للرئيسية
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .btn-outline-custom {
    border-color: #3cc88f;
    color: #3cc88f;
}

.btn-outline-custom:hover {
    background-color: #3cc88f;
    color: #fff;
}

.volunteer-events-section {
    background-color: #f8fafc;
}

.volunteer-card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    background: white;
    display: flex;
    flex-direction: column;
}

.volunteer-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.card-header {
    padding: 0;
    border: none;
    position: relative;
}

.card-header img {
    height: 200px;
    object-fit: cover;
    width: 100%;
}

.event-date-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    padding: 8px 12px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.event-date-badge .day {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
    line-height: 1;
}

.event-date-badge .month {
    display: block;
    font-size: 14px;
    color: #e74c3c;
    font-weight: 600;
    text-transform: uppercase;
}

.volunteer-progress {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100%;
    left: auto;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 10px 15px;
    border-top-left-radius: 8px;
    direction: rtl;
}

.progress-text {
    text-align: right;
    font-size: 12px;
    margin-bottom: 5px;
}

.progress {
    height: 6px;
    border-radius: 3px;
    background-color: rgba(255, 255, 255, 0.3);
}

.progress-bar {
    background-color: #4CAF50;
}

.card-body {
    padding: 20px;
    flex-grow: 1;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.card-title a {
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.3s;
}

.card-title a:hover {
    color: #e74c3c;
}

.event-meta {
    direction: rtl;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.meta-item {
    transition: all 0.3s ease;
    cursor: default;
}

.meta-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(60, 200, 143, 0.2);
}

.card-text {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}

.card-footer {
    padding: 15px 20px;
    background: #f8f9fa;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.card-footer .btn {
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 15px;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-warning {
    background-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.empty-events-state {
    background-color: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.empty-icon {
    color: #e74c3c;
    opacity: 0.8;
}

@media (max-width: 767px) {
    .card-footer {
        flex-direction: column;
    }

    .card-footer .btn {
        width: 100%;
        margin-bottom: 10px;
    }

    .card-footer .btn:last-child {
        margin-bottom: 0;
    }
}

@media (max-width: 576px) {
    .event-meta {
        flex-direction: column;
        gap: 8px;
    }
}
  /* Modern Hero Styles */
  .modern-hero {
        position: relative;
        overflow: hidden;
        height: 100vh;
        min-height: 700px;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #2c786c 0%, #3cc88f 100%);
    }

    .hero-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('images/hero-pattern.png') }}') center/cover no-repeat;
        opacity: 0.08;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
        padding-top: 80px;
    }

    .hero-text {
        max-width: 600px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        color: #fff;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .hero-title .highlight {
        color: #ffd700;
        position: relative;
        display: inline-block;
    }

    .hero-title .highlight:after {
        content: '';
        position: absolute;
        bottom: 10px;
        left: 0;
        width: 100%;
        height: 10px;
        background: rgba(255, 215, 0, 0.3);
        z-index: -1;
        border-radius: 5px;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .hero-cta .btn {
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .hero-cta .btn-primary {
        background-color: #ffd700;
        border-color: #ffd700;
        color: #2c3e50;
    }

    .hero-cta .btn-primary:hover {
        background-color: #ffc800;
        border-color: #ffc800;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 200, 0, 0.3);
    }

    .hero-cta .btn-outline-light {
        border: 2px solid rgba(255,255,255,0.3);
        color: white;
    }

    .hero-cta .btn-outline-light:hover {
        background-color: rgba(255,255,255,0.1);
        border-color: white;
    }

    .hero-image-container {
        position: relative;
    }

    .hero-image {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        transform: perspective(1000px) rotateY(-5deg);
        transition: all 0.5s ease;
    }

    .hero-image:hover {
        transform: perspective(1000px) rotateY(0deg);
    }

    .hero-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .floating-icons {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .floating-icons div {
        position: absolute;
        background: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3cc88f;
        font-size: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        animation: float 6s infinite ease-in-out;
    }

    .floating-icons .icon-1 {
        top: 20%;
        left: -20px;
        animation-delay: 0s;
    }

    .floating-icons .icon-2 {
        top: 60%;
        left: -10px;
        animation-delay: 1s;
    }

    .floating-icons .icon-3 {
        bottom: 20%;
        right: -20px;
        animation-delay: 2s;
    }

    .hero-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }

    .hero-wave svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 150px;
    }

    .badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(5px);
        border-radius: 30px;
        padding: 8px 20px;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .badge-text {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    .hero-stats {
        margin-bottom: 30px;
    }

    .stat-item {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(5px);
        padding: 15px 25px;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.2);
        text-align: center;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffd700;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.9rem;
        color: white;
        opacity: 0.9;
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


.auto-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.row.clearfix {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.event-block-three {
    padding: 0 15px;
    margin-bottom: 30px;
}

.event-block-three .inner-box {
    border: 1px solid #ddd;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.event-block-three:hover .inner-box {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.image-box {
    position: relative;
}

.image-box .image {
    margin: 0;
}

.image-box .image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
}

.date {
    position: absolute;
    top: 15px;
    right: 15px;
    background: white;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    color: #000;
    font-size: 18px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.month {
    font-size: 12px;
    text-transform: uppercase;
    display: block;
}

.lower-content {
    padding: 20px;
}

.lower-content h3 {
    margin: 0 0 15px;
    font-size: 1.25rem;
}

.lower-content h3 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.lower-content h3 a:hover {
    color: #3cc88f;
}

.info {
    list-style: none;
    padding: 0;
    margin: 0 0 15px;
    display: flex;
    justify-content: center;
    font-size: 14px;
    direction: rtl;
}

.info li {
    display: flex;
    align-items: center;
    margin: 0 15px;
    color: #666;
}

.info .icon {
    margin-right: 5px;
    color: #3cc88f;
}

.description {
    margin: 0 0 20px;
    color: #555;
    line-height: 1.5;
    font-size: 0.9rem;
}

.link-boxx{
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.link-boxx .btn-style-two {
    background-color: #3cc88f;
    color: #fff;
    padding: 6px 16px; /* حجم أصغر */
    border-radius: 18px;
    text-transform: uppercase;
    font-weight: bold;
    border: 1.5px solid #2eaa76; /* تخفيف سماكة الحدود */
    transition: all 0.3s ease;
    width: auto; /* إزالة العرض الكامل */
    display: inline-block; /* للتحكم بحجم الزر حسب المحتوى */
    font-size: 0.75rem;/* تحسين المظهر مع الخط الصغير */
    letter-spacing: 0.5px;
}

  /* Animations */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* Responsive Styles */
    @media (max-width: 1199px) {
        .hero-title {
            font-size: 3rem;
        }

        .section-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 991px) {
        .modern-hero {
            height: auto;
            min-height: auto;
            padding: 120px 0 80px;
        }

        .hero-content {
            padding-top: 0;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-text {
            text-align: center;
            margin: 0 auto 40px;
        }

        .hero-cta {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .hero-stats {
            justify-content: center;
        }

        .subscribe-content {
            padding-right: 0;
            margin-bottom: 40px;
            text-align: center;
        }

        .benefits-list {
            max-width: 400px;
            margin: 0 auto;
        }
    }

    @media (max-width: 767px) {
        .hero-title {
            font-size: 2.2rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .hero-cta .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .event-card {
            margin-bottom: 30px;
        }
    }

    @media (max-width: 575px) {
        .hero-title {
            font-size: 1.8rem;
        }

        .stat-item {
            padding: 10px 15px;
        }

        .stat-number {
            font-size: 1.5rem;
        }
    }

</style>


<!-- Animation Libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

<script>
    // Floating animation for hero elements
    document.addEventListener('DOMContentLoaded', function() {
        // Hero image floating animation
        const heroImage = document.querySelector('.hero-image');
        if (heroImage) {
            heroImage.style.transform = 'perspective(1000px) rotateY(-5deg)';
        }

        // Floating icons animation
        const floatingIcons = document.querySelectorAll('.floating-icons div');
        floatingIcons.forEach((icon, index) => {
            icon.style.animationDelay = `${index * 0.5}s`;
        });

        // Event card hover effects
        const eventCards = document.querySelectorAll('.event-card');
        eventCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
                this.style.boxShadow = '0 15px 30px rgba(0,0,0,0.1)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.05)';
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove('lazy-image');
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        document.querySelectorAll('.lazy-image').forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }
</script>

<!-- End Events Section -->

@endsection
