@extends('layouts.app')

@section('content')
    <section class="page-banner" style="background: linear-gradient(90deg, #3cc88f 0%, #2da578 100%);">
        <div class="bottom-rotten-curve" style="fill: #fff;"></div>
        <div class="auto-container">
            <div class="banner-content text-center py-5">
                <h1 class="text-white mb-3" style="font-weight: 700; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">{{ $event->title }}</h1>
                <ul class="bread-crumb clearfix d-flex justify-content-center">
                    <li><a href="{{ url('/') }}" class="text-white">الرئيسية</a></li>
                    <li class="active text-white">تفاصيل الحدث</li>
                </ul>
            </div>
        </div>
    </section>

<div class="event-details-page py-5" style="background-color: #f8f9fa;">
    <div class="auto-container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="event-card" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div class="event-image-container position-relative h-100">
                                <img class="img-fluid w-100 h-100 object-cover" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" style="min-height: 400px;">
                                <div class="event-date-overlay" style="position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.9); padding: 10px 15px; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    <div class="day" style="font-size: 24px; font-weight: bold; color: #3cc88f;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                    <div class="month" style="font-size: 16px; color: #555;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                </div>
                                @php
                                    $now = now();
                                    $startDateTime = \Carbon\Carbon::parse($event->date . ' ' . $event->time);
                                    $endDateTime = $event->end_time ? \Carbon\Carbon::parse($event->date . ' ' . $event->end_time) : $startDateTime->copy()->addHours(2);

                                    $isPastEvent = $endDateTime->isPast();
                                    $isOngoingEvent = $now->between($startDateTime, $endDateTime);
                                    $isUpcomingEvent = $startDateTime->isFuture();
                                @endphp
                                <div class="event-status-badge" style="position: absolute; top: 20px; left: 20px; z-index: 2;">
                                    @if($isPastEvent)
                                        <span class="badge bg-secondary py-2 px-3">منتهي</span>
                                    @elseif($isOngoingEvent)
                                        <span class="badge bg-primary py-2 px-3">جاري الآن</span>
                                    @elseif($isUpcomingEvent)
                                        <span class="badge bg-success py-2 px-3">قادم</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 bg-white p-4">
                            <div class="event-details-content h-100 d-flex flex-column">
                                <h2 class="mb-3" style="font-weight: 700; color: #333; font-size: 28px;">{{ $event->title }}</h2>

                                <div class="event-meta mb-4" style="direction: rtl;">
                                    <div class="d-flex align-items-center justify-content-center" style="gap: 15px; flex-wrap: wrap;">

                                        <div class="d-flex align-items-center" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                            <i class="far fa-clock ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                            <span style="font-size: 13px; font-weight: 500; display: flex; justify-content: flex-start; direction: ltr;">
                                                {{ $endDateTime->format('h:i A') }}
                                                <span style="color: #3cc88f; margin: 0 3px;">←</span>
                                                {{ $startDateTime->format('h:i A') }}
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                            <i class="far fa-calendar-alt ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                            <span style="font-size: 13px; font-weight: 500;">
                                                {{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                            <i class="fas fa-map-marker-alt ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                            <span style="font-size: 13px; font-weight: 500;">
                                                {{ $event->location }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if(session('message'))
                                    <div class="alert alert-success mb-4" style="border-radius: 8px; background-color: #e6f7ee; border-color: #3cc88f; color: #0a5c36;">
                                        <i class="fas fa-check-circle ml-2"></i> {{ session('message') }}
                                    </div>
                                @endif

                                <div class="event-description mb-4" style="flex-grow: 1;">
                                    <p style="line-height: 1.8; font-size: 16px; color: #555;">{{ $event->description }}</p>
                                </div>

                                <div class="volunteer-info mb-4">
                                    <div class="progress mb-2" style="height: 10px; border-radius: 5px;">
                                        <div class="progress-bar" role="progressbar"
                                            style="background-color: #3cc88f; width: {{ $event->volunteers_needed ? min(100, ($event->volunteer_count / $event->volunteers_needed) * 100) : 0 }}%;"
                                            aria-valuenow="{{ $event->volunteer_count }}"
                                            aria-valuemin="0"
                                            aria-valuemax="{{ $event->volunteers_needed ?? 1 }}">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span style="font-size: 14px; color: #666;">المتطوعون المسجلون: {{ $event->volunteer_count }}</span>
                                        <span style="font-size: 14px; color: #666;">المطلوب: {{ $event->volunteers_needed ?? 'غير محدد' }}</span>
                                    </div>
                                </div>

                                <div class="event-mission mb-4">
                                    <h4 style="font-weight: 600; color: #333; font-size: 18px; margin-bottom: 12px;">
                                        <i class="fas fa-tasks ml-2" style="color: #3cc88f;"></i> مهمة الحدث
                                    </h4>
                                    <p class="mb-2" style="font-size: 15px; color: #555;">{{ $event->mission ?? 'لا توجد مهمة محددة.' }}</p>
                                    <ul class="mission-points pl-3" style="list-style-type: none;">
                                        @if($event->mission_point_1)
                                            <li class="mb-2" style="position: relative; padding-right: 25px;">
                                                <i class="fas fa-circle" style="position: absolute; right: 0; top: 8px; font-size: 6px; color: #3cc88f;"></i>
                                                {{ $event->mission_point_1 }}
                                            </li>
                                        @endif
                                        @if($event->mission_point_2)
                                            <li class="mb-2" style="position: relative; padding-right: 25px;">
                                                <i class="fas fa-circle" style="position: absolute; right: 0; top: 8px; font-size: 6px; color: #3cc88f;"></i>
                                                {{ $event->mission_point_2 }}
                                            </li>
                                        @endif
                                        @if($event->mission_point_3)
                                            <li class="mb-2" style="position: relative; padding-right: 25px;">
                                                <i class="fas fa-circle" style="position: absolute; right: 0; top: 8px; font-size: 6px; color: #3cc88f;"></i>
                                                {{ $event->mission_point_3 }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="mt-auto">
                                    @auth
                                        @php
                                            $registrationOpen = (!$event->registration_start || $now >= $event->registration_start) &&
                                                              (!$event->registration_end || $now <= $event->registration_end);
                                        @endphp

                                        @if($event->volunteers()->where('user_id', auth()->user()->id)->exists())
                                            <button class="btn btn-block" style="background-color: #f8f9fa; color: #3cc88f; border: 1px solid #3cc88f; border-radius: 8px; padding: 10px; font-weight: 600;">
                                                <i class="fas fa-check ml-2"></i> أنت مسجل بالفعل
                                            </button>
                                        @elseif($isPastEvent)
                                            <button class="btn btn-block" style="background-color: #f8f9fa; color: #dc3545; border: 1px solid #dc3545; border-radius: 8px; padding: 10px; font-weight: 600;" disabled>
                                                <i class="fas fa-calendar-times ml-2"></i> الحملة منتهية
                                            </button>
                                        @elseif($isOngoingEvent)
                                            <button class="btn btn-block" style="background-color: #f8f9fa; color: #dc3545; border: 1px solid #dc3545; border-radius: 8px; padding: 10px; font-weight: 600;" disabled>
                                                <i class="fas fa-running ml-2"></i> الحملة جارية
                                            </button>
                                        @elseif($event->volunteers_needed > 0 && $event->volunteer_count >= $event->volunteers_needed)
                                            <button class="btn btn-block" style="background-color: #f8f9fa; color: #dc3545; border: 1px solid #dc3545; border-radius: 8px; padding: 10px; font-weight: 600;" disabled>
                                                <i class="fas fa-times ml-2"></i> اكتمل العدد
                                            </button>
                                        @elseif(!$registrationOpen)
                                            <button class="btn btn-block" style="background-color: #f8f9fa; color: #ffc107; border: 1px solid #ffc107; border-radius: 8px; padding: 10px; font-weight: 600;" disabled>
                                                <i class="fas fa-clock ml-2"></i>
                                                @if($event->registration_start && $now < $event->registration_start)
                                                    يبدأ التسجيل {{ $event->registration_start->diffForHumans() }}
                                                @else
                                                    انتهى التسجيل
                                                @endif
                                            </button>
                                        @else
                                            <a href="{{ route('event.subscribe', $event->id) }}" class="btn btn-block" style="background: linear-gradient(90deg, #3cc88f 0%, #2da578 100%); color: white; border-radius: 8px; padding: 12px; font-weight: 600; transition: all 0.3s; border: none;">
                                                <i class="fas fa-user-plus ml-2"></i> اشترك في الحدث
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-block" style="background-color: #f8f9fa; color: #3cc88f; border: 1px solid #3cc88f; border-radius: 8px; padding: 12px; font-weight: 600;">
                                            <i class="fas fa-sign-in-alt ml-2"></i> سجل الدخول للاشتراك
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--map-->
                <div class="map-section mt-5">
                    <div class="section-header mb-4 d-flex justify-content-between align-items-center">
                        <h3 style="font-weight: 700; color: #333;">
                            <i class="fas fa-map-marked-alt ml-2" style="color: #3cc88f;"></i> موقع الحدث
                        </h3>
                        @if($event->latitude && $event->longitude)
                            <a href="https://www.google.com/maps?q={{ $event->latitude }},{{ $event->longitude }}" target="_blank" class="btn" style="background-color: #3cc88f; color: white; border-radius: 8px; padding: 8px 16px; font-size: 14px;">
                                <i class="fas fa-external-link-alt ml-2"></i> فتح في خرائط جوجل
                            </a>
                        @endif
                    </div>

                    @if($event->latitude && $event->longitude)
                        <div id="map-canvas"
                             style="height: 400px; width: 100%; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);"
                             data-zoom="15"
                             data-lat="{{ $event->latitude }}"
                             data-lng="{{ $event->longitude }}"
                             data-type="roadmap"
                             data-hue="#3cc88f"
                             data-title="{{ $event->title }}"
                             data-content="{{ $event->location }}">
                        </div>
                    @else
                        <div class="alert alert-warning text-center py-4" style="border-radius: 12px;">
                            <i class="fas fa-map-marker-slash fa-2x mb-3" style="color: #ffc107;"></i>
                            <h4>لا تتوفر معلومات الموقع الجغرافي</h4>
                            <p class="mb-0">عفواً، لا توجد إحداثيات متاحة لعرض الخريطة</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    @if($event->latitude && $event->longitude)
    <script>
        function initMap() {

            var eventLocation = {
                lat: parseFloat("{{ $event->latitude ?? '0' }}"),
                lng: parseFloat("{{ $event->longitude ?? '0' }}")
            };

            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 12,
                center: eventLocation,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });


            var marker = new google.maps.Marker({
                position: eventLocation,
                map: map,
                title: "{{ $event->location ?? 'موقع الحدث' }}",
                icon: "images/icons/map-marker.png"
            });
        }
    </script>
    <script>
        function initMap() {

            const mapElement = document.getElementById('map-canvas');
            if (!mapElement) return;

            const eventLocation = {
                lat: parseFloat(mapElement.dataset.lat),
                lng: parseFloat(mapElement.dataset.lng)
            };

            const loadingOverlay = document.createElement('div');
            loadingOverlay.style.position = 'absolute';
            loadingOverlay.style.top = '0';
            loadingOverlay.style.left = '0';
            loadingOverlay.style.right = '0';
            loadingOverlay.style.bottom = '0';
            loadingOverlay.style.backgroundColor = 'rgba(255,255,255,0.7)';
            loadingOverlay.style.display = 'flex';
            loadingOverlay.style.justifyContent = 'center';
            loadingOverlay.style.alignItems = 'center';
            loadingOverlay.innerHTML = '<div class="spinner-border text-success" role="status"><span class="sr-only">جاري التحميل...</span></div>';
            mapElement.appendChild(loadingOverlay);

            const map = new google.maps.Map(mapElement, {
                zoom: parseInt(mapElement.dataset.zoom) || 15,
                center: eventLocation,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{"color": "#3cc88f"}]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [{"visibility": "off"}]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [{"visibility": "off"}]
                    }
                ]
            });

            loadingOverlay.style.display = 'none';

            const marker = new google.maps.Marker({
                position: eventLocation,
                map: map,
                title: mapElement.dataset.title,
                icon: {
                    url: "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2248%22%20height%3D%2248%22%20viewBox%3D%220%200%2048%2048%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M24%204c-7.73%200-14%206.27-14%2014%200%2010.5%2014%2026%2014%2026s14-15.5%2014-26c0-7.73-6.27-14-14-14zm0%2019c-2.76%200-5-2.24-5-5s2.24-5%205-5%205%202.24%205%205-2.24%205-5%205z%22%20fill%3D%22%233cc88f%22%2F%3E%3C%2Fsvg%3E",
                    scaledSize: new google.maps.Size(40, 40)
                }
            });

            const infowindow = new google.maps.InfoWindow({
                content: `<strong>${mapElement.dataset.title}</strong><br>${mapElement.dataset.content}`
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }

        function loadGoogleMaps() {
            const script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCM-Zm_CIm_E5GNXHoZdid3ku7416v57pc&callback=initMap';
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }

        window.addEventListener('load', loadGoogleMaps);
    </script>
    @endif
@endsection

<link href="{{ asset('css/event-single.css') }}" rel="stylesheet">


