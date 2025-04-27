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


                {{-- <li style="min-width: 180px;">
                    <label for="location" style="display: block; font-weight: bold; margin-bottom: 5px; text-align:right">الموقع</label>
                    <select name="location" id="location" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                        <option value="">-- اختر --</option>
                        @foreach($locations as $location)
                            <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>{{ $location }}</option>
                        @endforeach
                    </select>
                </li> --}}


                {{-- <li style="min-width: 180px;">
                    <label for="end_time" style="display: block; font-weight: bold; margin-bottom: 5px; text-align:right">تاريخ الانتهاء</label>
                    <input type="date" name="end_time" id="end_time" value="{{ request('end_time') }}" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                </li> --}}

                {{-- <li style="min-width: 180px;">
                    <label for="sort_by" style="display: block; font-weight: bold; margin-bottom: 5px; text-align:right">ترتيب حسب</label>
                    <select name="sort_by" id="sort_by" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                        <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>الاسم</option>
                        <option value="goal_amount" {{ request('sort_by') == 'goal_amount' ? 'selected' : '' }}>الهدف</option>
                        <option value="end_time" {{ request('sort_by') == 'end_time' ? 'selected' : '' }}>تاريخ الانتهاء</option>
                    </select>
                </li> --}}

                <li style="min-width: 180px;">
                    <label for="sort_direction" style="display: block; font-weight: bold; margin-bottom: 5px; text-align:right">اتجاه الترتيب</label>
                    <select name="sort_direction" id="sort_direction" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                        <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>تصاعدي</option>
                        <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>تنازلي</option>
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
            <div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden d-flex flex-column">
                <!-- Image -->
                <a href="{{ route('cause.show', $cause->id) }}">
                    <img class="card-img-top" src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}" style="height: 230px; object-fit: cover;">
                </a>

                <!-- Content -->
                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                    <h5 class="card-title text-primary">{{ $cause->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($cause->description, 100) }}</p>

                    <div class="d-flex justify-content-between mt-3 small text-secondary">
                        <span><i class="fa fa-tag me-1"></i> {{ $cause->category }}</span>
                        <span><i class="fa fa-map-marker-alt me-1"></i> {{ $cause->location }}</span>
                    </div>

                    <!-- Progress -->
                    <div class="mt-3">
                        @php
                            $percentage = $cause->goal_amount > 0
                                ? ($cause->raised_amount / $cause->goal_amount) * 100
                                : 0;
                        @endphp

                        <div class="progress position-relative" style="height: 20px; background-color: #f1f1f1;">
                            <div class="progress-bar bg-success d-flex align-items-center justify-content-center text-white fw-bold"
                                 role="progressbar"
                                 style="width: {{ $percentage }}%;"
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

                    <!-- Button -->
                    <div class="mt-5 mt-auto">
                        <a href="{{ route('cause.show', $cause->id) }}"
                           class="btn w-100 rounded-pill"
                           style="border: 2px solid #3cc88f; color: #3cc88f;">
                            اقرأ المزيد
                        </a>
                    </div>


                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted">
            لا توجد حملات تطابق الفلتر المحدد.
        </div>
    @endforelse
</div>


<!-- Pagination -->
<div class="mt-4">
    {{ $causes->links() }}
</div>


</section>

<style>


    .link-box {
    text-align: center;
    display: flex;
    justify-content: center;
}

.theme-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

#Read_more {
    display: inline-block;
}

.card {
    border-radius: 12px;
    padding: 15px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-group input, .form-group select, .form-group button {
    border-radius: 8px;
}

/* مثال على الزر */
.theme-btn {
    border-radius: 30px;  /* جعل الزر دائري أو منحنٍ بشكل كبير */
}


</style>

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
