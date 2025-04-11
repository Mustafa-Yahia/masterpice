@extends('layouts.app')

    @section('content')

    <!-- Causes Section Two -->
    <section class="causes-section-two">
        <div class="auto-container">
            <div class="sec-title centered">
                <div class="sub-title">أسبابنا</div>
                <h2>الأسباب الشعبية</h2>
                <div class="text">Cupidatat non proident sunt</div>
            </div>
            <div id="causes-list" class="row clearfix">
                @foreach($causes as $cause)
                    <div class="cause-block-two col-lg-4 col-md-6 col-sm-12 cause-item" data-title="{{ $cause->title }}" data-raised="{{ $cause->raised_amount }}" data-goal="{{ $cause->goal_amount }}" data-category="{{ $cause->category }}" data-end="{{ $cause->end_time }}">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('cause.show', $cause->id) }}">
                                        <img class="img-fluid" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">
                                    </a>
                                </figure>
                            </div>
                            <div class="lower-content">
                                <h3><a href="{{ route('cause.show', $cause->id) }}">{{ $cause->title }}</a></h3>
                                <div class="text">{{ $cause->description }}</div>
                            </div>
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
                                <div class="link-box">
                                    <a href="{{ route('cause.show', $cause->id) }}" class="theme-btn btn-style-two"><span class="btn-title">اقرأ المزيد</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    @endsection

    <style>
        /* إضافة تنسيق الفلاتر لظهورها بجانب بعضها */
        .filter-form {
            margin-bottom: 30px;
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 15px;  /* مسافة بين الفلاتر */
        }

        .form-group {
            flex: 1;
            min-width: 200px;
            max-width: 300px; /* الحد الأقصى لعرض الفلاتر */
            margin-bottom: 15px;
            text-align: right;  /* محاذاة النص والحقول إلى اليمين */
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            text-align: right;  /* محاذاة النص إلى اليمين */
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 1px;
            border: 1px solid #ccc;
            border-radius: 4px;
            direction: rtl;  /* جعل الحقول تظهر من اليمين لليسار */
        }

        .cause-block-two {
            margin-bottom: 30px;
        }

        .cause-block-two .inner-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .cause-block-two .image-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .cause-block-two .lower-content {
            margin-top: 15px;
            flex-grow: 1;
        }

        .cause-block-two .donate-info {
            margin-top: 10px;
        }
    </style>
