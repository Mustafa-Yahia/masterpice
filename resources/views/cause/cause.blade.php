@extends('layouts.app')

@section('content')
<section class="causes-section-two">
    <div class="auto-container">

        <div class="sec-title centered text-center">
            <h2 style="text-align: center">ساهم في التغيير وادعم حملة إنسانية اليوم <i class="fa fa-heart"></i></h2>
            <div class="text">بمساعدتك، نستطيع رسم البسمة على وجوه المحتاجين. اختر حملة وساهم بالفرق الآن.</div>
        </div>

        <form id="filter-form" class="filter-form mb-4" action="{{ route('cause.index') }}" method="GET">
            <ul style="display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: center; gap: 20px; padding: 20px; margin: 0 0 30px 0; direction: rtl; list-style: none; border-radius: 8px; background: #f9f9f9;">

                <li style="min-width: 180px;">
                    <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px; text-align:right">اسم الحملة</label>
                    <input type="text" name="title" id="title" value="{{ request('title') }}" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                </li>

                <li style="min-width: 180px;">
                    <label for="category" style="display: block; font-weight: bold; margin-bottom: 5px; text-align:right">الفئة</label>
                    <select name="category" id="category" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                        <option value="">-- اختر --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </li>

                <li style="min-width: 180px;">
                    <label style="visibility: hidden; display: block;">تطبيق</label>
                    <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">تطبيق الفلتر</span></button>
                </li>

                <li style="min-width: 180px;">
                    <label style="visibility: hidden; display: block;">إعادة تعيين</label>
                    <button type="button" id="reset-filters" class="theme-btn btn-style-one"><span class="btn-title">إعادة تعيين الفلاتر</span></button>
                </li>
            </ul>
        </form>

   <div id="causes-list" class="row gy-4">
    @forelse($causes as $cause)

    <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden d-flex flex-column cause-card">

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

                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                    <div>
                        <h5 class="card-title text-primary" style="text-align: center">{{ $cause->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($cause->description, 100) }}</p>

                        <div class="d-flex justify-content-between mt-3 small text-secondary">
                            <span><i class="fa fa-tag me-1"></i> {{ $cause->category }}</span>
                            <span><i class="fa fa-map-marker-alt me-1"></i> {{ $cause->location }}</span>
                        </div>

                        <div class="mt-3 progress-container">
                            @php
                                $percentage = $cause->goal_amount > 0
                                    ? ($cause->raised_amount / $cause->goal_amount) * 100
                                    : 0;
                            @endphp

                            <div class="progress position-relative" style="height: 20px; background-color: #cbcbcb;">
                                <div class="progress-bar bg-success progress-animate"
                                     role="progressbar"
                                     style="width: {{ $percentage }}%;"
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
        <div class="col-12">
            <div class="empty-causes-state text-center p-5 rounded-4 bg-light position-relative overflow-hidden">

                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
                    <div class="pattern-dots-md" style="color: #0d6efd;"></div>
                </div>

                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-heart-broken fa-3x text-muted mb-4"></i>
                        <h4 class="text-secondary" style="text-align: center">لا توجد حملات متاحة حالياً</h4>
                        <p class="text-muted" style="text-align: center">سنقوم بإضافة حملات جديدة قريباً، تفضل بزيارتنا لاحقاً</p>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</div>

@if($causes->hasPages())
<div class="mt-5">
    <nav aria-label="Page navigation">
        {{ $causes->onEachSide(1)->links('pagination::bootstrap-5') }}
    </nav>
</div>
@endif

<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.progress-animate');

        progressBars.forEach(bar => {
            const percentage = bar.dataset.percentage;
            bar.style.width = `${percentage}%`;
        });

        if ('loading' in HTMLImageElement.prototype) {
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            lazyImages.forEach(img => {
                img.loading = 'lazy';
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.progress-animate');

        const animateProgressBars = () => {
            progressBars.forEach(bar => {
                const percentage = bar.getAttribute('data-percentage');
                bar.style.width = percentage + '%';
            });
        };

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
    document.getElementById('reset-filters').addEventListener('click', function() {
        document.getElementById('filter-form').reset();

        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('title');
        urlParams.delete('category');
        urlParams.delete('goal_amount');
        urlParams.delete('location');
        urlParams.delete('end_time');
        urlParams.delete('sort_by');
        urlParams.delete('sort_direction');

        window.location.search = urlParams.toString();
    });
</script>

<script>
    $(document).ready(function () {
        $('#filter-form').on('submit', function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('cause.filter') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#causes-list').html(data);
                    animateProgress();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        function animateProgress() {
            $('.bar-inner.animate-progress').each(function () {
                var percent = $(this).data('percent');
                $(this).css({ width: 0 }).animate({ width: percent }, 800);
            });
        }

        animateProgress();
    });

    <script>
    function activateProgressBars() {
        document.querySelectorAll('.count-bar').forEach(function(bar) {
            const percent = bar.getAttribute('data-percent');
            bar.style.width = percent;
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        activateProgressBars();
    });

    $(document).ready(function () {
        $('#filter-form').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('cause.filter') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#causes-list').html(data);
                    activateProgressBars();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

</script>

@endsection
