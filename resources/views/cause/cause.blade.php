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

                <!-- الحقول الموجودة -->
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

                <!-- زر إعادة تعيين الفلاتر -->
                <li style="min-width: 180px;">
                    <label style="visibility: hidden; display: block;">إعادة تعيين</label>
                    <button type="button" id="reset-filters" class="theme-btn btn-style-one"><span class="btn-title">إعادة تعيين الفلاتر</span></button>
                </li>
            </ul>
        </form>
   <!-- عرض الحملات -->
<div id="causes-list" class="row gy-4">
    @forelse($causes as $cause)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden d-flex flex-column cause-card">
                <!-- Badge for urgent causes -->
                @if($cause->is_urgent)
                <div class="urgent-badge">
                    <span class="badge bg-danger py-2 px-3 rounded-pill pulse-animation">
                        <i class="fas fa-exclamation-circle me-1"></i> حملة عاجلة
                    </span>
                </div>
                @endif

                <!-- Image with hover effect -->
                <a href="{{ route('cause.show', $cause->id) }}" class="cause-image-link">
                    <img class="card-img-top cause-image" src="{{ asset('storage/' . $cause->image) }}" alt="{{ $cause->title }}" loading="lazy">
                    <div class="image-overlay">
                        <span class="view-details-btn">عرض التفاصيل</span>
                    </div>
                </a>

                <!-- Content -->
                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                    <div>
                        <h5 class="card-title text-primary">{{ $cause->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($cause->description, 100) }}</p>

                        <div class="d-flex justify-content-between mt-3 small text-secondary">
                            <span><i class="fa fa-tag me-1"></i> {{ $cause->category }}</span>
                            <span><i class="fa fa-map-marker-alt me-1"></i> {{ $cause->location }}</span>
                        </div>

                        <!-- Progress with animation -->
                        <div class="mt-3 progress-container">
                            @php
                                $percentage = $cause->goal_amount > 0
                                    ? ($cause->raised_amount / $cause->goal_amount) * 100
                                    : 0;
                            @endphp

                            <div class="progress position-relative" style="height: 20px; background-color: #f1f1f1;">
                                <div class="progress-bar bg-success progress-animate"
                                     role="progressbar"
                                     style="width: 0;"
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

                    <!-- Button with hover effect -->
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
        <div class="col-12 text-center text-muted py-5 empty-state">
            <i class="far fa-folder-open fa-3x mb-3"></i>
            <h4 class="mb-3">لا توجد حملات تطابق الفلتر المحدد</h4>
            <a href="{{ route('causes.index') }}" class="btn btn-outline-primary rounded-pill">
                عرض جميع الحملات
            </a>
        </div>
    @endforelse
</div>

<!-- Pagination with style -->
@if($causes->hasPages())
<div class="mt-5">
    <nav aria-label="Page navigation">
        {{ $causes->onEachSide(1)->links('pagination::bootstrap-5') }}
    </nav>
</div>
@endif

<style>
    /* Base Styles */
    .cause-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }

    .cause-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    /* Image Styles */
    .cause-image-link {
        position: relative;
        display: block;
        overflow: hidden;
        height: 230px;
    }

    .cause-image {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(60, 200, 143, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .view-details-btn {
        color: white;
        font-weight: bold;
        padding: 8px 16px;
        border: 2px solid white;
        border-radius: 30px;
        transform: scale(0.9);
        transition: all 0.3s ease;
    }

    .cause-image-link:hover .cause-image {
        transform: scale(1.05);
    }

    .cause-image-link:hover .image-overlay {
        opacity: 1;
    }

    .cause-image-link:hover .view-details-btn {
        transform: scale(1);
    }

    /* Progress Bar Animation */
    .progress-animate {
        transition: width 1.5s ease-in-out;
    }

    /* Read More Button */
    .read-more-btn {
        border: 2px solid #3cc88f;
        color: #3cc88f;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .read-more-btn:hover {
        background-color: #3cc88f;
        color: white;
    }

    .read-more-btn .transition-all {
        transition: all 0.3s ease;
    }

    .read-more-btn:hover .transition-all {
        transform: translateX(-5px);
    }

    /* Urgent Badge */
    .urgent-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
        }
    }

    /* Empty State */
    .empty-state {
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 40px 20px !important;
    }

    /* Pagination Styles */
    .pagination {
        justify-content: center;
    }

    .page-item.active .page-link {
        background-color: #3cc88f;
        border-color: #3cc88f;
    }

    .page-link {
        color: #3cc88f;
        margin: 0 5px;
        border-radius: 50% !important;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .page-link:hover {
        color: #2da876;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars on scroll
        const progressBars = document.querySelectorAll('.progress-animate');

        const animateProgressBars = () => {
            progressBars.forEach(bar => {
                const percentage = bar.getAttribute('data-percentage');
                bar.style.width = percentage + '%';
            });
        };

        // Intersection Observer for progress bars
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

        // Add hover effect to cards
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
        // إعادة تعيين جميع الحقول في النموذج
        document.getElementById('filter-form').reset();

        // إعادة تعيين القيم المرسلة في الرابط (URL)
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('title');
        urlParams.delete('category');
        urlParams.delete('goal_amount');
        urlParams.delete('location');
        urlParams.delete('end_time');
        urlParams.delete('sort_by');
        urlParams.delete('sort_direction');

        // إعادة تحميل الصفحة مع الفلاتر المعاد تعيينها
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
                    activateProgressBars(); // إعادة التفعيل بعد تحميل الفلتر
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
