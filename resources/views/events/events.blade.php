@extends('layouts.app')

@section('content')

<!-- Page Banner Section -->
<section class="page-banner">
    <div class="image-layer lazy-image" data-bg="url('images/background/bg-banner-1.jpg')"></div>
    <div class="bottom-rotten-curve"></div>

    <div class="auto-container">
        <h1>أحداثنا</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="active">أحداثنا</li>
        </ul>
    </div>
</section>


<section class="events-section">
    <div class="auto-container">
        <div class="row clearfix">
            @foreach($events as $event)
                <div class="event-block-three col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms">
                        <div class="image-box">
                            <figure class="image">
                                <a href="{{ route('event.show', $event->id) }}">
                                    <img class="lazy-image" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">

                                </a>
                            </figure>
                            <div class="date">{{ \Carbon\Carbon::parse($event->date)->format('d') }} <span class="month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span></div>
                        </div>
                        <div class="lower-content">
                            <h3><a href="{{ route('event.show', $event->id) }}">{{ $event->title }}</a></h3>
                            <ul class="info clearfix" style="direction: rtl">
                                <li><span class="icon fa fa-map-marker-alt"></span> {{ $event->location }}</li>
                                <li><span class="icon far fa-clock"></span> {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}</li>
                            </ul>
                            <p class="description">{{ $event->description }}</p>
                            <div class="link-boxx">
                                <a href="{{ route('event.show', $event->id) }}" class="theme-btn btn-style-two">
                                    <span class="btn-title">قراءة المزيد</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<style>
    .events-section {
    padding: 60px 0;
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
</style>

<!-- End Events Section -->

@endsection
