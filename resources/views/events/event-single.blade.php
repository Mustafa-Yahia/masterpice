@extends('layouts.app')

@section('content')
    <!-- صفحة البانر المعدلة -->
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

    <!-- محتوى الصفحة الرئيسي -->
    <div class="event-details-page py-5" style="background-color: #f8f9fa;">
        <div class="auto-container">
            <div class="row justify-content-center">
                <!-- بطاقة الحدث الرئيسية -->
                <div class="col-lg-10">
                    <div class="event-card" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                        <div class="row no-gutters">
                            <!-- صورة الحدث -->
                            <div class="col-md-6">
                                <div class="event-image-container position-relative h-100">
                                    <img class="img-fluid w-100 h-100 object-cover" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" style="min-height: 400px;">
                                    <div class="event-date-overlay" style="position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.9); padding: 10px 15px; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        <div class="day" style="font-size: 24px; font-weight: bold; color: #3cc88f;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                        <div class="month" style="font-size: 16px; color: #555;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- تفاصيل الحدث -->
                            <div class="col-md-6 bg-white p-4">
                                <div class="event-details-content h-100 d-flex flex-column">
                                    <!-- العنوان والمعلومات الأساسية -->
                                    <h2 class="mb-3" style="font-weight: 700; color: #333; font-size: 28px;">{{ $event->title }}</h2>

                                    {{-- <div class="event-meta mb-4" style="direction: rtl;">
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 30px; flex-wrap: wrap;">


                                            <!-- التاريخ -->
                                            <div class="d-flex align-items-center">
                                                <div class="icon-circle" style="width: 32px; height: 32px; background-color: #f0faf6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: 8px;">
                                                    <i class="far fa-calendar-alt" style="color: #3cc88f; font-size: 14px;"></i>
                                                </div>
                                                <span style="font-size: 15px; font-weight: 500;">
                                                    {{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}
                                                </span>
                                            </div>


                                            <!-- الموقع -->
                                            <div class="d-flex align-items-center">
                                                <div class="icon-circle" style="width: 32px; height: 32px; background-color: #f0faf6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: 8px;">
                                                    <i class="fas fa-map-marker-alt" style="color: #3cc88f; font-size: 14px;"></i>
                                                </div>
                                                <span style="font-size: 15px; font-weight: 500;">
                                                    {{ $event->location }}
                                                </span>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="event-meta mb-4" style="direction: rtl;">
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 15px; flex-wrap: wrap;">
                                            <!-- الوقت -->
                                            <div class="d-flex align-items-center" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                                <i class="far fa-clock ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                                <span style="font-size: 13px; font-weight: 500;">
                                                    {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
                                                    <span style="color: #3cc88f; margin: 0 3px;">←</span>
                                                    @if($event->end_time)
                                                        {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($event->time)->addHours(2)->format('h:i A') }}
                                                    @endif
                                                </span>
                                            </div>

                                            <!-- التاريخ -->
                                            <div class="d-flex align-items-center" style="background: #f8faf9; padding: 6px 12px; border-radius: 20px; border-right: 2px solid #3cc88f;">
                                                <i class="far fa-calendar-alt ml-2" style="color: #3cc88f; font-size: 13px;"></i>
                                                <span style="font-size: 13px; font-weight: 500;">
                                                    {{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}
                                                </span>
                                            </div>

                                            <!-- الموقع -->
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

                                    <!-- وصف الحدث -->
                                    <div class="event-description mb-4" style="flex-grow: 1;">
                                        <p style="line-height: 1.8; font-size: 16px; color: #555;">{{ $event->description }}</p>
                                    </div>

                                    <!-- معلومات المتطوعين -->
                                    <div class="volunteer-info mb-4">
                                        <div class="progress mb-2" style="height: 10px; border-radius: 5px;">
                                            <div class="progress-bar" role="progressbar"
                                            style="background-color: #3cc88f; width: {{ $event->volunteers_needed ? min(100, ($event->volunteer_count / $event->volunteers_needed) * 100) : 0 }}%;"                                                 aria-valuenow="{{ $event->volunteer_count }}"
                                                 aria-valuemin="0"
                                                 aria-valuemax="{{ $event->volunteers_needed ?? 1 }}">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span style="font-size: 14px; color: #666;">المتطوعون المسجلون: {{ $event->volunteer_count }}</span>
                                            <span style="font-size: 14px; color: #666;">المطلوب: {{ $event->volunteers_needed ?? 'غير محدد' }}</span>
                                        </div>
                                    </div>

                                    <!-- مهمة الحدث -->
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

                                    <!-- زر الاشتراك -->
                                    <div class="mt-auto">
                                        @auth
                                            @if($event->volunteers()->where('user_id', auth()->user()->id)->exists())
                                                <button class="btn btn-block" style="background-color: #f8f9fa; color: #3cc88f; border: 1px solid #3cc88f; border-radius: 8px; padding: 10px; font-weight: 600;">
                                                    <i class="fas fa-check ml-2"></i> أنت مسجل بالفعل
                                                </button>
                                            @elseif($event->volunteers_needed > $event->volunteer_count)
                                                <a href="{{ route('event.subscribe', $event->id) }}" class="btn btn-block" style="background: linear-gradient(90deg, #3cc88f 0%, #2da578 100%); color: white; border-radius: 8px; padding: 12px; font-weight: 600; transition: all 0.3s; border: none;">
                                                    <i class="fas fa-user-plus ml-2"></i> اشترك في الحدث
                                                </a>
                                            @else
                                                <button class="btn btn-block" style="background-color: #f8f9fa; color: #dc3545; border: 1px solid #dc3545; border-radius: 8px; padding: 10px; font-weight: 600;" disabled>
                                                    <i class="fas fa-times ml-2"></i> اكتمل العدد
                                                </button>
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

                    <!-- قسم الخريطة -->
                    {{-- <div class="map-section mt-5">
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

                        <div id="map-canvas"
                             style="height: 400px; width: 100%; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);"
                             data-zoom="15"
                             data-lat="{{ $event->latitude ?? '0' }}"
                             data-lng="{{ $event->longitude ?? '0' }}"
                             data-type="roadmap"
                             data-hue="#3cc88f"
                             data-title="{{ $event->title }}"
                             data-content="{{ $event->location }}">
                        </div>
                    </div> --}}
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
            // تأكد من وجود الإحداثيات (latitude و longitude) في قاعدة البيانات
            var eventLocation = {
                lat: parseFloat("{{ $event->latitude ?? '0' }}"),
                lng: parseFloat("{{ $event->longitude ?? '0' }}")
            };

            // إعداد الخريطة
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 12,
                center: eventLocation,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // إضافة علامة للموقع
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
            // التحقق من وجود العنصر أولاً
            const mapElement = document.getElementById('map-canvas');
            if (!mapElement) return;

            const eventLocation = {
                lat: parseFloat(mapElement.dataset.lat),
                lng: parseFloat(mapElement.dataset.lng)
            };

            // إنشاء الخريطة مع إضافة رسالة تحميل
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

            // إزالة رسالة التحميل بعد ظهور الخريطة
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

        // تحميل API بشكل متأخر لضمان تحميل الصفحة أولاً
        function loadGoogleMaps() {
            const script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCM-Zm_CIm_E5GNXHoZdid3ku7416v57pc&callback=initMap';
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }

        // تحميل الخريطة بعد تحميل الصفحة
        window.addEventListener('load', loadGoogleMaps);
    </script>
    @endif
@endsection

<style>
    .time-range {
        position: relative;
        padding: 0 10px;
    }

    .time-range::before {
        content: "";
        position: absolute;
        right: -15px;
        top: 50%;
        transform: translateY(-50%);
        height: 20px;
        width: 1px;
        background-color: #e0e0e0;
    }

    .time-range::after {
        content: "";
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        height: 20px;
        width: 1px;
        background-color: #e0e0e0;
    }

    @media (max-width: 768px) {
        .time-range::before,
        .time-range::after {
            display: none;
        }
    }
</style>

{{-- @extends('layouts.app')

@section('content')
    <!-- صفحة البانر -->
    <section class="page-banner">
        <div class="image-layer lazy-image" data-bg="url('images/background/bg-banner-1.jpg')"></div>
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">
            <h1>تفاصيل الحدث</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">الرئيسية</a></li>
                <li class="active">تفاصيل الحدث</li>
            </ul>
        </div>
    </section>
    <!-- End Banner Section -->
<!-- Sidebar Page Container -->
<div class="sidebar-page-container" style="direction: rtl;">
    <div class="auto-container">
        <div class="row clearfix justify-content-center">
            <!-- Content Side / تفاصيل الحدث -->
            <div class="content-side col-lg-10 col-md-12 col-sm-12">
                <div class="event-details">
                    <div class="inner-box d-flex flex-wrap" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; background: #fff;">
                        <!-- صورة الحدث -->
                        <div class="image-box col-md-6" style="padding-left: 15px; padding-right: 15px;">
                            <figure class="image position-relative">
                                <img class="lazy-image" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" style="width: 100%; border-radius: 10px;">

                                <div class="date" style="position: absolute; top: 10px; right: 10px; background-color: rgba(0, 0, 0, 0.6); color: white; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d') }}
                                    <span class="month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                                </div>
                            </figure>
                        </div>

                        <!-- محتوى الحدث -->
                        <div class="lower-content col-md-6" style="text-align: right; padding-left: 15px; padding-right: 15px;">
                            <h2 style="font-size: 24px; font-weight: bold; color: #333;">{{ $event->title }}</h2>

                            <ul class="info clearfix" style="list-style: none; padding: 0; margin-top: 15px;">
                                <li style="margin-bottom: 10px;">
                                    <i class="far fa-clock" style="margin-left: 8px; color: #3cc88f;"></i>
                                    {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
                                </li>
                                <li>
                                    <i class="fa fa-map-marker-alt" style="margin-left: 8px; color: #3cc88f;"></i>
                                    {{ $event->location }}
                                </li>
                            </ul>

                            @if(session('message'))
                                <div class="alert alert-success text-center mt-3" style="font-size: 16px; font-weight: bold;">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <div class="text-content mt-3">
                                <p style="font-size: 16px; line-height: 1.7;">{{ $event->description }}</p>
                            </div>

                            <h3 class="mt-4" style="font-size: 18px; font-weight: bold;">عدد المتطوعين المطلوبين</h3>
                            <p>{{ $event->volunteers_needed ?? 'لم يتم تحديد عدد المتطوعين.' }}</p>

                            <div class="volunteer-info mt-3">
                                <h3>عدد المتطوعين الذين اشتركوا: {{ $event->volunteer_count }}</h3>
                            </div>

                            <h3 class="mt-4" style="font-size: 18px; font-weight: bold;">مهمة الحدث</h3>
                            <p>{{ $event->mission ?? 'لا توجد مهمة محددة.' }}</p>
                            <ul style="font-size: 16px; padding-right: 20px;">
                                <li>{{ $event->mission_point_1 ?? 'نقطة مهمة 1 غير متوفرة.' }}</li>
                                <li>{{ $event->mission_point_2 ?? 'نقطة مهمة 2 غير متوفرة.' }}</li>
                                <li>{{ $event->mission_point_3 ?? 'نقطة مهمة 3 غير متوفرة.' }}</li>
                            </ul>

                            <h3 class="mt-4" style="font-size: 18px; font-weight: bold;">موقع الحدث</h3>
                            <!-- زر يقوم بنقل المستخدم إلى الخريطة باستخدام الإحداثيات -->
                            @if($event->latitude && $event->longitude)
                                <div class="text-center">
                                    <a href="https://www.google.com/maps?q={{ $event->latitude }},{{ $event->longitude }}" target="_blank" class="btn btn-primary" style="font-size: 16px; padding: 10px 20px; background-color: #3cc88f; color: white; border-radius: 5px;">
                                        انتقل إلى الموقع على الخريطة
                                    </a>
                                </div>
                            @else
                                <p style="text-align: center; color: #ff6347; font-weight: bold;">لا توجد إحداثيات لهذا الموقع.</p>
                            @endif

                            @auth
                                @if($event->volunteers()->where('user_id', auth()->user()->id)->exists())
                                    <p class="text-center mt-3" style="color: #ff6347; font-weight: bold;">لقد تم الاشتراك بالفعل في هذا الحدث.</p>
                                @elseif($event->volunteers_needed > $event->volunteer_count)
                                    <div class="text-center mt-3">
                                        <a href="{{ route('event.subscribe', $event->id) }}" class="btn" style="padding: 10px 25px; background-color: #3cc88f; color: white; border-radius: 5px;">
                                            اشترك في الحدث
                                        </a>
                                    </div>
                                @else
                                    <p class="text-center mt-3" style="color: #ff6347; font-weight: bold;">لقد تم استكمال عدد المتطوعين.</p>
                                @endif
                            @else
                                <p class="text-center mt-3" style="color: #333;">يرجى تسجيل الدخول للاشتراك في الحدث.</p>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content Side -->


                <!-- الخريطة أسفل الصورة -->
                <div class="col-lg-12">
                    <div class="map-box" style="margin-top: 20px;">
                        <div id="map-canvas"
                            style="height: 400px; width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);"
                            data-zoom="12"
                            data-lat="{{ $event->latitude ?? '0' }}"
                            data-lng="{{ $event->longitude ?? '0' }}"
                            data-type="roadmap"
                            data-hue="#ffc400"
                            data-title="{{ $event->location ?? 'موقع الحدث' }}"
                            data-icon-path="images/icons/map-marker.png"
                            data-content="{{ $event->location ?? 'موقع الحدث' }}">
                        </div>
                    </div>
                </div>
                <!-- End Map Section -->

            </div>
        </div>
    </div>
    <!-- End Sidebar Page Container -->

    <!-- إعدادات Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCM-Zm_CIm_E5GNXHoZdid3ku7416v57pc&callback=initMap" async defer></script>

    <script>
        function initMap() {
            // تأكد من وجود الإحداثيات (latitude و longitude) في قاعدة البيانات
            var eventLocation = {
                lat: parseFloat("{{ $event->latitude ?? '0' }}"),
                lng: parseFloat("{{ $event->longitude ?? '0' }}")
            };

            // إعداد الخريطة
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 12,
                center: eventLocation,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // إضافة علامة للموقع
            var marker = new google.maps.Marker({
                position: eventLocation,
                map: map,
                title: "{{ $event->location ?? 'موقع الحدث' }}",
                icon: "images/icons/map-marker.png"
            });
        }
    </script>
@endsection
 --}}


{{-- @extends('layouts.app')

@section('content')
    <!-- صفحة البانر -->
    <section class="page-banner">
        <div class="image-layer lazy-image" data-bg="url('images/background/bg-banner-1.jpg')"></div>
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">
            <h1>تفاصيل الحدث</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">الرئيسية</a></li>
                <li class="active">تفاصيل الحدث</li>
            </ul>
        </div>
    </section>
    <!-- End Banner Section -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container" style="direction: rtl;">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Content Side / تفاصيل الحدث -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="event-details">
                        <div class="inner-box" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; background: #fff;">
                            <!-- صورة الحدث -->
                            <div class="image-box" style="margin-bottom: 20px;">
                                <figure class="image">
                                    <img class="lazy-image" src="{{ asset('storage/events/' . $event->image) }}" alt="{{ $event->title }}" style="width: 100%; border-radius: 10px;">
                                </figure>
                                <div class="date" style="position: absolute; top: 10px; left: 10px; background-color: rgba(0, 0, 0, 0.5); color: white; padding: 5px 10px; border-radius: 5px;">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d') }} <span class="month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                                </div>
                            </div>

                            <div class="lower-content" style="text-align: right;">
                                <!-- عنوان الحدث -->
                                <h2 style="font-size: 24px; font-weight: bold; color: #333; margin-bottom: 15px;">{{ $event->title }}</h2>

                                <!-- معلومات الحدث (الوقت والموقع) -->
                                <ul class="info clearfix" style="text-align: right; list-style-position: inside; margin-bottom: 20px;">
                                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <span class="icon far fa-clock" style="margin-left: 10px; color: #3cc88f;"></span>
                                        <span>{{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}</span>
                                    </li>
                                    <li style="display: flex; align-items: center;">
                                        <span class="icon fa fa-map-marker-alt" style="margin-left: 10px; color: #3cc88f;"></span>
                                        <span>{{ $event->location }}</span>
                                    </li>
                                </ul>

                                <!-- عرض رسالة الاشتراك -->
                                @if(session('message'))
                                    <div class="alert alert-success" style="font-size: 16px; color: #4CAF50; font-weight: bold; text-align: center;">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <!-- وصف الحدث -->
                                <div class="text-content" style="margin-bottom: 30px;">
                                    <p style="line-height: 1.6em; font-size: 16px;">{{ $event->description }}</p>
                                </div>

                                 <!-- إضافة قسم عدد المتطوعين المطلوبين -->
                                 <h3 style="font-size: 20px; font-weight: bold; color: #333; margin-top: 30px;">عدد المتطوعين المطلوبين</h3>
                                 <p>{{ $event->volunteers_needed ?? 'لم يتم تحديد عدد المتطوعين المطلوبين لهذا الحدث.' }}</p>

                                 <div class="volunteer-info" style="margin-top: 20px;">
                                    <h3>عدد المتطوعين الذين اشتركوا: {{ $event->volunteer_count }}</h3>
                                </div>

                                <!-- قسم مهمة الحدث -->
                                <h3 style="font-size: 20px; font-weight: bold; color: #333; margin-top: 20px;">مهمة الحدث</h3>
                                <p>{{ $event->mission ?? 'لا توجد تفاصيل مهمة لهذا الحدث.' }}</p>
                                <ul style="padding-left: 20px; font-size: 16px;">
                                    <li>{{ $event->mission_point_1 ?? 'نقطة مهمة 1 غير متوفرة.' }}</li>
                                    <li>{{ $event->mission_point_2 ?? 'نقطة مهمة 2 غير متوفرة.' }}</li>
                                    <li>{{ $event->mission_point_3 ?? 'نقطة مهمة 3 غير متوفرة.' }}</li>
                                </ul>

                                <!-- قسم الموقع -->
                                <h3 style="font-size: 20px; font-weight: bold; color: #333; margin-top: 30px;">موقع الحدث</h3>
                                <p>{{ $event->location_details ?? 'لا توجد تفاصيل موقع لهذا الحدث.' }}</p>

                                 <!-- التحقق من حالة الاشتراك -->
                                 @if(auth()->check())
                                     @if($event->volunteers()->where('user_id', auth()->user()->id)->exists())
                                         <!-- إذا كان المستخدم قد اشترك بالفعل -->
                                         <div class="text-center">
                                             <p style="font-size: 16px; color: #ff6347; font-weight: bold;">لقد تم الاشتراك في هذا الحدث بالفعل.</p>
                                         </div>
                                     @elseif($event->volunteers_needed > $event->volunteer_count)
                                         <!-- إذا كان هناك متطوعون متاحون -->
                                         <div class="text-center">
                                             <a href="{{ route('event.subscribe', $event->id) }}" class="btn btn-primary" style="padding: 10px 20px; font-size: 16px; background-color: #3cc88f; color: white; border-radius: 5px;">
                                                 اشترك في الحدث
                                             </a>
                                         </div>
                                     @else
                                         <!-- إذا تم استكمال عدد المتطوعين -->
                                         <div class="text-center">
                                             <p style="font-size: 16px; color: #ff6347; font-weight: bold;">لقد تم استكمال عدد المتطوعين.</p>
                                         </div>
                                     @endif
                                 @else
                                     <p style="text-align: center; color: #333; font-size: 16px;">يرجى تسجيل الدخول للاشتراك في الحدث.</p>
                                 @endif

                                <!-- قسم الخريطة -->
                                <div class="map-box" style="margin-top: 20px;">
                                    <div id="map-canvas"
                                        style="height: 400px; width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);"
                                        data-zoom="12"
                                        data-lat="{{ $event->latitude ?? '0' }}"
                                        data-lng="{{ $event->longitude ?? '0' }}"
                                        data-type="roadmap"
                                        data-hue="#ffc400"
                                        data-title="{{ $event->location ?? 'موقع الحدث' }}"
                                        data-icon-path="images/icons/map-marker.png"
                                        data-content="{{ $event->location ?? 'موقع الحدث' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content Side -->
            </div>
        </div>
    </div>
    <!-- End Sidebar Page Container -->

    <!-- إعدادات Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCM-Zm_CIm_E5GNXHoZdid3ku7416v57pc&callback=initMap" async defer></script>

    <script>
        function initMap() {
            // تأكد من وجود الإحداثيات (latitude و longitude) في قاعدة البيانات
            var eventLocation = {
                lat: parseFloat("{{ $event->latitude ?? '0' }}"),
                lng: parseFloat("{{ $event->longitude ?? '0' }}")
            };

            // إعداد الخريطة
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 12,
                center: eventLocation,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // إضافة علامة للموقع
            var marker = new google.maps.Marker({
                position: eventLocation,
                map: map,
                title: "{{ $event->location ?? 'موقع الحدث' }}",
                icon: "images/icons/map-marker.png"
            });
        }
    </script>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')
<section class="event-single py-5">
    <div class="auto-container">
        <h2>{{ $event->title }}</h2>
        <div class="image-box">
            <img src="{{ asset('storage/images/' . $event->image) }}" alt="{{ $event->title }}" class="img-fluid">
        </div>
        <p>{{ $event->description }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
        <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}</p>
        <p><strong>Location:</strong> {{ $event->location }}</p>

        <!-- Check if the user is logged in and registered for the event -->
        @if(Auth::check() && !Auth::user()->events->contains($event))
            <form action="{{ route('event.register', $event->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Register for this Event</button>
            </form>
        @else
            <p>You are already registered or need to login to register.</p>
        @endif
    </div>
</section>
@endsection --}}
