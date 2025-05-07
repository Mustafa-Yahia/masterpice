@extends('layouts.app')
@section('content')

<!-- Banner Section -->
<section class="impact-banner" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/impact-bg.jpg') }}'); background-size: cover; padding: 100px 0; text-align: center; color: white;">
    <div class="auto-container">
        <h1 style="font-size: 42px; margin-bottom: 20px;">التأثير الذي نصنعه معاً</h1>
        <p style="font-size: 18px; max-width: 800px; margin: 0 auto;">شاهد كيف تتحول التبرعات والأعمال التطوعية إلى تغيير ملموس في حياة الناس والمجتمعات</p>
    </div>
</section>

<!-- Transformation Stories Section -->
<section class="transformation-section" style="padding: 80px 0; background-color: #f9f9f9;">
    <div class="auto-container">
        <div class="sec-title text-center" style="margin-bottom: 60px;">
            <h2 style="color: #3cc88f;">قصص التحول</h2>
            <p>من حال إلى حال أفضل بفضل دعمكم وتطوعكم</p>
        </div>

        <div class="row">
            <!-- Transformation 1 -->
            <div class="col-lg-6 col-md-12 mb-5">
                <div class="transformation-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div class="before-after" style="position: relative; height: 300px;">
                        <div class="before" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('{{ asset('images/school-before.jpg') }}') center/cover;"></div>
                        <div class="after" style="position: absolute; top: 0; left: 0; width: 50%; height: 100%; background: url('{{ asset('images/school-after.jpg') }}') center/cover; border-right: 3px solid #3cc88f;"></div>
                        <div class="slider-handle" style="position: absolute; left: 50%; top: 0; bottom: 0; width: 4px; background: #3cc88f; cursor: ew-resize;"></div>
                    </div>
                    <div class="content" style="padding: 20px;">
                        <h3 style="color: #3cc88f;">مدرسة القرية</h3>
                        <p>من مبنى مهدم إلى مدرسة حديثة بفصول دراسية مجهزة، استفاد منها أكثر من 200 طالب وطالبة</p>
                        <div class="stats" style="display: flex; justify-content: space-between; margin-top: 15px;">
                            <div>
                                <span style="font-weight: bold; color: #3cc88f;">التبرعات:</span>
                                <span>250,000 ريال</span>
                            </div>
                            <div>
                                <span style="font-weight: bold; color: #3cc88f;">المتطوعون:</span>
                                <span>45 متطوع</span>
                            </div>
                            <div>
                                <span style="font-weight: bold; color: #3cc88f;">المدة:</span>
                                <span>6 أشهر</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transformation 2 -->
            <div class="col-lg-6 col-md-12 mb-5">
                <div class="transformation-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div class="before-after" style="position: relative; height: 300px;">
                        <div class="before" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('{{ asset('images/house-before.jpg') }}') center/cover;"></div>
                        <div class="after" style="position: absolute; top: 0; left: 0; width: 50%; height: 100%; background: url('{{ asset('images/house-after.jpg') }}') center/cover; border-right: 3px solid #3cc88f;"></div>
                        <div class="slider-handle" style="position: absolute; left: 50%; top: 0; bottom: 0; width: 4px; background: #3cc88f; cursor: ew-resize;"></div>
                    </div>
                    <div class="content" style="padding: 20px;">
                        <h3 style="color: #3cc88f;">منزل الأسرة الفقيرة</h3>
                        <p>تحول من خيمة صغيرة إلى منزل آمن يحمي من تقلبات الطقس ويوفر حياة كريمة لأسرة مكونة من 7 أفراد</p>
                        <div class="stats" style="display: flex; justify-content: space-between; margin-top: 15px;">
                            <div>
                                <span style="font-weight: bold; color: #3cc88f;">التبرعات:</span>
                                <span>120,000 ريال</span>
                            </div>
                            <div>
                                <span style="font-weight: bold; color: #3cc88f;">المتطوعون:</span>
                                <span>30 متطوع</span>
                            </div>
                            <div>
                                <span style="font-weight: bold; color: #3cc88f;">المدة:</span>
                                <span>3 أشهر</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Impact Statistics Section -->
<section class="impact-stats" style="padding: 80px 0; background: linear-gradient(135deg, #3cc88f 0%, #2da578 100%); color: white;">
    <div class="auto-container">
        <div class="sec-title text-center" style="margin-bottom: 60px;">
            <h2>أرقامنا تتحدث</h2>
            <p>إنجازاتنا بفضل دعمكم الكريم</p>
        </div>

        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-item" style="padding: 20px;">
                    <h3 style="font-size: 42px; font-weight: bold; margin-bottom: 10px;">47</h3>
                    <p>مشروعاً تم إنجازه</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-item" style="padding: 20px;">
                    <h3 style="font-size: 42px; font-weight: bold; margin-bottom: 10px;">1,250</h3>
                    <p>متطوع مشارك</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-item" style="padding: 20px;">
                    <h3 style="font-size: 42px; font-weight: bold; margin-bottom: 10px;">4.7M</h3>
                    <p>ريال قيمة التبرعات</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-item" style="padding: 20px;">
                    <h3 style="font-size: 42px; font-weight: bold; margin-bottom: 10px;">12,500</h3>
                    <p>مستفيد مباشر</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section" style="padding: 80px 0; background-color: white;">
    <div class="auto-container">
        <div class="sec-title text-center" style="margin-bottom: 60px;">
            <h2 style="color: #3cc88f;">كلمات الشكر</h2>
            <p>ما يقوله المستفيدون والمتطوعون</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card" style="background: #f9f9f9; padding: 30px; border-radius: 10px; height: 100%;">
                    <div class="quote-icon" style="color: #3cc88f; font-size: 30px; margin-bottom: 15px;">"</div>
                    <p style="font-style: italic; margin-bottom: 20px;">بفضل الله ثم بفضل المتبرعين والمتطوعين، تحولت حياتنا من الشقاء إلى السعادة. بني لنا منزل أحلامنا بعد أن كنا نعيش في خيمة.</p>
                    <div class="author" style="display: flex; align-items: center;">
                        <img src="{{ asset('images/testimonial1.jpg') }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-left: 15px;">
                        <div>
                            <h5 style="margin-bottom: 0;">أحمد السليم</h5>
                            <small>مستفيد من مشروع بناء المنازل</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card" style="background: #f9f9f9; padding: 30px; border-radius: 10px; height: 100%;">
                    <div class="quote-icon" style="color: #3cc88f; font-size: 30px; margin-bottom: 15px;">"</div>
                    <p style="font-style: italic; margin-bottom: 20px;">شاركت في بناء مدرسة القرية وكانت من أجمل التجارب في حياتي. رؤية الفرحة في عيون الأطفال عند افتتاح المدرسة لا تقدر بثمن.</p>
                    <div class="author" style="display: flex; align-items: center;">
                        <img src="{{ asset('images/testimonial2.jpg') }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-left: 15px;">
                        <div>
                            <h5 style="margin-bottom: 0;">نورة الفهد</h5>
                            <small>متطوعة في مشروع المدارس</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card" style="background: #f9f9f9; padding: 30px; border-radius: 10px; height: 100%;">
                    <div class="quote-icon" style="color: #3cc88f; font-size: 30px; margin-bottom: 15px;">"</div>
                    <p style="font-style: italic; margin-bottom: 20px;">كنت أشعر أن تبرعاتي الصغيرة لا قيمة لها، لكن عندما زرت المشاريع وشاهدت تأثيرها، أدركت أن كل ريال يحدث فرقاً.</p>
                    <div class="author" style="display: flex; align-items: center;">
                        <img src="{{ asset('images/testimonial3.jpg') }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-left: 15px;">
                        <div>
                            <h5 style="margin-bottom: 0;">خالد الرشيد</h5>
                            <small>متبرع دائم</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="padding: 60px 0; background-color: #3cc88f; color: white; text-align: center;">
    <div class="auto-container">
        <h2 style="margin-bottom: 20px;">كن جزءاً من التغيير</h2>
        <p style="font-size: 18px; max-width: 700px; margin: 0 auto 30px;">ساهم معنا في صنع المزيد من قصص النجاح وتحويل الأحلام إلى حقائق</p>
        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <a href="donate" class="btn" style="background: white; color: #3cc88f; padding: 12px 30px; border-radius: 30px; font-weight: bold; text-decoration: none;">تبرع الآن</a>
            <a href="volunteer" class="btn" style="background: transparent; border: 2px solid white; color: white; padding: 12px 30px; border-radius: 30px; font-weight: bold; text-decoration: none;">تطوع معنا</a>
        </div>
    </div>
</section>

<script>
// Simple before-after slider functionality
document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('.before-after');

    sliders.forEach(slider => {
        const handle = slider.querySelector('.slider-handle');
        const after = slider.querySelector('.after');
        let isDragging = false;

        function moveSlider(e) {
            if (!isDragging) return;

            const rect = slider.getBoundingClientRect();
            let x = e.clientX - rect.left;

            // Constrain x to slider boundaries
            x = Math.max(0, Math.min(x, rect.width));

            const percent = (x / rect.width) * 100;

            after.style.width = `${percent}%`;
            handle.style.left = `${percent}%`;
        }

        handle.addEventListener('mousedown', () => isDragging = true);
        document.addEventListener('mouseup', () => isDragging = false);
        document.addEventListener('mousemove', moveSlider);

        // Touch support
        handle.addEventListener('touchstart', () => isDragging = true);
        document.addEventListener('touchend', () => isDragging = false);
        document.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            moveSlider(e.touches[0]);
        });
    });
});
</script>

<!-- End Video Section -->


{{-- <section class="volunteer-section py-5" style="background-color: #f0f4f8; direction: rtl; text-align: right;">
    <div class="container">
        <div class="sec-title text-center mb-5">
            <h2 class="fw-bold text-dark">نموذج التطوع <i class="fa fa-handshake"></i></h2>
            <p class="text-muted">املأ النموذج التالي للانضمام إلى برامج التطوع <i class="fa fa-users"></i></p>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('volunteer.store') }}" class="shadow p-4 bg-white rounded">
            @csrf

            <!-- المعلومات الشخصية -->
            <h5 class="fw-bold mb-3 text-dark"><i class="fa fa-user"></i> المعلومات الشخصية</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">الاسم الكامل</label>
                    <input type="text" name="full_name" class="form-control form-control-lg" placeholder="أدخل اسمك بالكامل" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">تاريخ الميلاد</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control form-control-lg" required>
                    <div id="age-error" class="text-danger" style="display: none;">يجب أن يكون عمرك 18 عامًا أو أكثر لتقديم الطلب.</div>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label for="phone" class="form-label d-block mb-2">رقم الهاتف <i class="fa fa-phone"></i></label>
                    <input type="tel" name="phone" id="phone" class="form-control form-control-lg" required>
                    <div id="phone-error" class="text-danger mt-1" style="display: none;">رقم الهاتف غير صالح. يرجى التأكد من صحة الرقم.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">الجنسية <i class="fa fa-flag"></i></label>
                    <div class="select-wrapper">
                        <select name="nationality" class="form-select form-select-lg" id="nationality" required>
                            <option selected disabled>اختر الجنسية</option>
                            <option value="الأردنية">الأردنية</option>
                            <option value="المصرية">المصرية</option>
                            <option value="السعودية">السعودية</option>
                            <option value="الإماراتية">الإماراتية</option>
                            <!-- أضف بقية الجنسيات هنا -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-2" id="national_id_row" style="display: none;">
                <div class="col-md-6">
                    <label for="national_id" class="form-label">رقم الهوية الوطنية</label>
                    <input type="text" name="national_id" id="national_id" class="form-control form-control-lg" placeholder="أدخل الرقم الوطني" maxlength="10">
                    <div id="national_id-error" class="text-danger mt-1" style="display: none;">الرقم الوطني غير صالح. يجب أن يتكون من 10 أرقام ويبدأ بـ "2".</div>
                </div>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-dark"><i class="fa fa-info-circle"></i> التفاصيل الشخصية</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">الجنس <i class="fa fa-genderless"></i></label>
                    <select name="gender" class="form-select form-select-lg" required>
                        <option selected disabled>اختر الجنس</option>
                        <option value="ذكر">ذكر</option>
                        <option value="أنثى">أنثى</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الدولة <i class="fa fa-globe"></i></label>
                    <select name="country" class="form-select form-select-lg" required>
                        <option selected disabled>اختر الدولة</option>
                        <option value="الأردن">الأردن</option>
                        <option value="مصر">مصر</option>
                        <option value="السعودية">السعودية</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">المدينة <i class="fa fa-building"></i></label>
                    <input type="text" name="city" class="form-control form-control-lg" placeholder="أدخل المدينة" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">المهنة <i class="fa fa-briefcase"></i></label>
                    <select name="occupation" class="form-select form-select-lg">
                        <option selected disabled>اختر المهنة</option>
                        <option value="طالب مدرسة">طالب مدرسة</option>
                        <option value="طالب جامعة">طالب جامعة</option>
                        <option value="موظف">موظف</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-dark"><i class="fa fa-envelope"></i> معلومات الاتصال</h5>
            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="أدخل بريدك الإلكتروني" required>
            </div>
            <h5 class="fw-bold mt-6 mb-3 text-dark"><i class="fa fa-handshake"></i> برامج التطوع</h5>
            <div class="mb-3" style="margin-top: 20px;"> <!-- إضافة مسافة بين العنوان والـ checkboxes -->
                <div class="d-flex flex-column gap-4">
                    @foreach ($volunteerPrograms as $program)
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="volunteer_programs[]" value="{{ $program->id }}" class="form-check-input" id="program-{{ $program->id }}">
                            <label class="form-check-label me-3 mr-4" for="program-{{ $program->id }}">{{ $program->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>


            <h5 class="fw-bold mt-4 mb-3 text-dark"><i class="fa fa-calendar-check"></i> المشاركة في التطوع</h5>
            <div class="mb-3">
                <label class="form-label">هل شاركت في التطوع خلال الثلاث سنوات الماضية؟</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input type="radio" name="previous_volunteer" value="1" class="form-check-input" id="previous_yes" onclick="toggleVolunteerField(true)" required>
                        <label class="form-check-label me-3 mr-4" for="previous_yes">نعم</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="previous_volunteer" value="0" class="form-check-input" id="previous_no" onclick="toggleVolunteerField(false)" required>
                        <label class="form-check-label me-3 mr-4" for="previous_no">لا</label>
                    </div>
                </div>
            </div>

            <div id="volunteer_details" class="mb-3" style="display: none;">
                <label class="form-label">ماذا تطوعت؟</label>
                <textarea name="volunteer_experience" class="form-control form-control-lg" rows="3" placeholder="أدخل تفاصيل تطوعك هنا..."></textarea>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-dark"><i class="fa fa-bullhorn"></i> كيف سمعت عن البرنامج؟</h5>
            <div class="mb-3">
                <select name="how_heard" class="form-select form-select-lg" style="padding-left: 50px;">
                    <option selected disabled>اختر الطريقة</option>
                    <option value="الأصدقاء">الأصدقاء</option>
                    <option value="العائلة">العائلة</option>
                    <option value="مواقع التواصل الاجتماعي">مواقع التواصل الاجتماعي</option>
                </select>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn px-5 py-2 btn-lg btn-white-text" style="background-color: #3cc88f;">
                    <i class="fa fa-paper-plane"></i> إرسال الطلب
                </button>
            </div>

        </form>
    </div>
</section>

<style>
    .btn-white-text {
    color: #fff !important;
}

</style>

<script src="{{ asset('js/Volunteer.js') }}" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'تم الإرسال بنجاح!',
                text: '{{ session("success") }}',
                confirmButtonText: 'حسنًا',
                timer: 5000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'خطأ في الإدخال!',
                text: '{{ session("error") }}',
                confirmButtonText: 'حسنًا',
            });
        @endif

        @if ($errors->any())
            let errorMessages = "";
            @foreach ($errors->all() as $error)
                errorMessages += "{{ $error }}\n";
            @endforeach
            Swal.fire({
                icon: 'error',
                title: 'تحقق من المدخلات!',
                text: errorMessages,
                confirmButtonText: 'حسنًا',
            });
        @endif
    });
</script>

<style>
    .form-select.custom-select {
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}

@endsection
