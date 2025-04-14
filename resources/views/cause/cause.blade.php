@extends('layouts.app')

@section('content')
<section class="causes-section-two">
    <div class="auto-container">

        <div class="sec-title centered text-center">
            <h2 style="text-align: center">ساهم في التغيير وادعم حملة إنسانية اليوم</h2>
            <div class="text">بمساعدتك، نستطيع رسم البسمة على وجوه المحتاجين. اختر حملة وساهم بالفرق الآن.</div>
        </div>

        {{-- <!-- نموذج الفلاتر بدون استخدام Bootstrap -->
        <form id="filter-form" class="filter-form mb-4">
            <ul class="filter-list" style="display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: center; gap: 20px; padding: 20px; margin: 0 0 30px 0; direction: rtl; list-style: none; border-radius: 8px; background: #f9f9f9;">
                <li style="min-width: 180px;">
                    <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px; text-align:right">اسم الحملة</label>
                    <input type="text" name="title" id="title" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                </li>
                <li style="min-width: 180px;">
                    <label for="category" style="display: block; font-weight: bold; margin-bottom: 5px;  text-align:right">الفئة</label>
                    <select name="category" id="category" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                        <option value="">-- اختر --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </li>
                <li style="min-width: 180px;">
                    <label for="goal_amount" style="display: block; font-weight: bold; margin-bottom: 5px;  text-align:right">الحد الأدنى للهدف</label>
                    <input type="number" name="goal_amount" id="goal_amount" style="padding: 8px; border: 1px solid #ccc; border-radius: 6px; width: 100%;">
                </li>

                <li style="min-width: 180px;">
                    <label style="visibility: hidden; display: block;">تطبيق</label>
                    <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">تطبيق الفلتر</span></button>
                </li>
            </ul>
        </form> --}}

        <!-- عرض الحملات -->
        <div id="causes-list" class="row clearfix">
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
                                    <div class="bar-inner count-bar animate-progress" data-percent="{{ $cause->raised_amount / $cause->goal_amount * 100 }}%">
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
        </div>

        <div class="mt-4">
            {{ $causes->links() }}
        </div>

    </div>
</section>

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

    // تشغيل عند أول تحميل
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
