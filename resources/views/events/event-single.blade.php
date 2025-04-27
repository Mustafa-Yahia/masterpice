@extends('layouts.app')

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
                                <img class="lazy-image" src="{{ asset('storage/events/' . $event->image) }}" alt="{{ $event->title }}" style="width: 100%; border-radius: 10px;">
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
