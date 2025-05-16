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
                                {{-- <a href="#subscribe" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-bell me-2"></i> اشترك للتنبيهات
                                </a> --}}
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



<!-- Events Section -->
<section class="volunteer-events-section py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($events as $event)
                @php
                    $eventDate = \Carbon\Carbon::parse($event->date);
                    $startDateTime = \Carbon\Carbon::parse($event->date . ' ' . $event->time);
                    $endDateTime = $event->end_time ? \Carbon\Carbon::parse($event->date . ' ' . $event->end_time) : $startDateTime->copy()->addHours(2);
                    $now = \Carbon\Carbon::now();

                    $isPastEvent = $endDateTime->isPast();
                    $isTodayEvent = $eventDate->isToday();
                    $isUpcomingEvent = $startDateTime->isFuture();
                    $isOngoingEvent = $now->between($startDateTime, $endDateTime);

                    $registrationOpen = (!$event->registration_start || $now >= $event->registration_start) &&
                                        (!$event->registration_end || $now <= $event->registration_end);
                @endphp

                <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <div class="volunteer-card h-100">
                        <div class="card-header position-relative">


                            <div class="event-status-badge">
                                @if($isPastEvent)
                                    <span class="badge bg-secondary">منتهي</span>
                                @elseif($isOngoingEvent)
                                    <span class="badge bg-primary">جاري الآن</span>
                                @elseif($isTodayEvent)
                                    <span class="badge bg-info">قريباً اليوم</span>
                                @elseif($isUpcomingEvent)
                                    <span class="badge bg-success">قادم</span>
                                @endif
                            </div>


                            <a href="{{ route('event.show', $event->id) }}">
                                <img class="card-img-top" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                            </a>

                            <div class="event-date-badge">
                                <span class="day">{{ $eventDate->format('d') }}</span>
                                <span class="month">{{ $eventDate->format('M') }}</span>
                            </div>

                            @if($event->volunteers_needed > 0)
                                <div class="volunteer-progress mt-2 px-2">
                                    <div class="progress-text small mb-1">
                                        المتطوعون: {{ $event->volunteers_count }}/{{ $event->volunteers_needed }}
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success"
                                             role="progressbar"
                                             style="width: {{ ($event->volunteers_count / $event->volunteers_needed) * 100 }}%"
                                             aria-valuenow="{{ $event->volunteers_count }}"
                                             aria-valuemin="0"
                                             aria-valuemax="{{ $event->volunteers_needed }}">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <h3 class="card-title text-center">
                                <a href="{{ route('event.show', $event->id) }}">{{ $event->title }}</a>
                            </h3>

                            <div class="event-meta d-flex flex-wrap gap-2">

                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="fas fa-map-marker-alt ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500;">{{ $event->location }}</span>
                                </div>

                                <div class="d-flex align-items-center meta-item" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                    <i class="far fa-clock ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                    <span style="font-size: 13px; font-weight: 500; direction: ltr;">
                                        {{ $endDateTime->format('h:i A') }}
                                        <span style="color: #3cc88f; margin: 0 3px;">←</span>
                                        {{ $startDateTime->format('h:i A') }}
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
                            </div>

                            <p class="card-text mt-3">{{ Str::limit($event->description, 100) }}</p>
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
                                    @if($isPastEvent)
                                        <button class="btn btn-danger" disabled>
                                            <i class="fas fa-times-circle me-2"></i> الحملة منتهية
                                        </button>
                                    @elseif($isOngoingEvent)
                                        <button class="btn btn-danger" disabled>
                                            <i class="fas fa-running me-2"></i> الحملة جارية
                                        </button>
                                    @elseif($event->volunteers_count >= $event->volunteers_needed)
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
                                        <a href="{{ route('event.subscribe', $event->id) }}" class="btn btn-outline-custom">
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
                        <h3 class="mb-3 text-center">لا توجد حملات تطوعية حالياً</h3>
                        <p class="text-muted mb-4 text-center">يمكنك متابعتنا لمعرفة أحدث الحملات التطوعية القادمة</p>
                        <a href="{{ route('index') }}" class="btn px-4" style="background: #3cc88f; color: #FFF;">
                            <i class="fas fa-home me-2"></i> العودة للرئيسية
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>



    <link href="{{ asset('css/event.css') }}" rel="stylesheet">


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
