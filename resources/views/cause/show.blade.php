

@extends('layouts.app')

@section('content')
    <div class="row clearfix">
        <!--Content Side / Blog Sidebar-->
        <div class="content-side col-lg-8 col-md-12 col-sm-12">
            <!--Cause Details-->
            <div class="cause-details">
                <div class="inner-box">
                    <!-- Image Section -->
                    <div class="image-box">
                        <figure class="image">
                            <img class="lazy-image" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">
                        </figure>
                    </div>

                    <!-- Donate Info -->
                    <div class="donate-info">
                        <div class="progress-box">
                            <div class="bar">
                                <div class="bar-inner count-bar" data-percent="{{ $cause->raised_amount / $cause->goal_amount * 100 }}%">
                                    <div class="count-text">{{ number_format($cause->raised_amount / $cause->goal_amount * 100, 0) }}%</div>
                                </div>
                            </div>
                        </div>
                        <div class="donation-count clearfix">
                            <span class="raised"><strong>تم جمع:</strong> ${{ $cause->raised_amount }}</span>
                            <span class="goal"><strong>الهدف:</strong> ${{ $cause->goal_amount }}</span>
                        </div>
                    </div>

                    <!-- Lower Content Section -->
                    <div class="lower-content">
                        <div class="text-content">
                            <h2>{{ $cause->title }}</h2>
                            <p>{{ $cause->description }}</p>

                            <!-- Example additional details -->
                            @if($cause->additional_details)
                                <h3>تفاصيل إضافية</h3>
                                <p>{{ $cause->additional_details }}</p>
                            @endif

                        </div>

                        <!-- Donate Button -->
                        <div class="link-box">
                            {{-- <a href="{{ route('donate') }}" class="theme-btn btn-style-one"> --}}
                            <a href="#" class="theme-btn btn-style-one">
                                <span class="btn-title">تبرع الآن</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Call to Action Section -->
    <section class="call-to-action-two">
        <div class="auto-container">
            <div class="inner clearfix">
                <div class="title-box"><h2>كن متطوعًا</h2></div>
                <div class="link-box">
                    <a href="contact.html" class="theme-btn btn-style-five">
                        <span class="btn-title">انضم الآن</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
