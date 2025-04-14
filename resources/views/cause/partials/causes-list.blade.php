@forelse($causes as $cause)
    <div class="cause-block-two col-lg-4 col-md-6 col-sm-12">
        <div class="inner-box wow fadeInUp">
            <div class="image-box">
                <figure class="image">
                    <a href="{{ route('cause.show', $cause->id) }}">
                        <img class="img-fluid" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">
                    </a>
                </figure>
            </div>
            <div class="lower-content">
                <h3><a href="{{ route('cause.show', $cause->id) }}">{{ $cause->title }}</a></h3>
                <div class="text">{{ Str::limit($cause->description, 100) }}</div>
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
                    <span class="raised"><strong>تم جمع:</strong> {{ number_format($cause->raised_amount, 2) }} د.أ</span>
                    <span class="goal"><strong>الهدف:</strong> {{ number_format($cause->goal_amount, 2) }} د.أ</span>
                </div>
                <div class="link-box">
                    <a href="{{ route('cause.show', $cause->id) }}" class="theme-btn btn-style-two">
                        <span class="btn-title">اقرأ المزيد</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-center text-muted">لا توجد حملات تطابق الفلتر المحدد.</p>
@endforelse
