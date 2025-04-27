<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <title>LoveUs - Charity and Fundraising HTML Template | Home Page 01</title>

    <!-- فقط اختر واحدة من النسخ -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cause.css') }}" rel="stylesheet">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Adding Font Awesome for Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

    <!-- إضافة مكتبة Flatpickr -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body>

    {{-- ✅ الهيدر --}}
    <x-header />

    {{-- ✅ محتوى الصفحة --}}
    <main>
        @yield('content')
    </main>

    <div class="scroll-to-top scroll-to-target" data-target="html">
        <span class="flaticon-up-arrow"></span>
    </div>

    {{-- ✅ الفوتر --}}
    <x-footer />

    {{-- السكربتات الأخرى --}}
    <script src="{{ asset('js/jquery.js') }}"></script> <!-- إزالة CDN jQuery إذا كنت تستخدم الملف المحلي فقط -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('js/owl.js') }}"></script>
    <script src="{{ asset('js/appear.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/lazyload.js') }}"></script>
    <script src="{{ asset('js/scrollbar.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- إضافة مكتبة Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // تفعيل Flatpickr لاختيار تاريخ انتهاء البطاقة بتنسيق MM/YY
        flatpickr("#card_expiry", {
            dateFormat: "m/y",  // تنسيق التاريخ كما MM/YY
            minDate: "today",   // تحديد الحد الأدنى للتاريخ ليكون اليوم
        });

        document.querySelector('.scroll-to-top').addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // تأكد من تنفيذ SweetAlert2 عندما يكون هناك session status
        $(document).ready(function() {
            if ('{{ session('status') }}') {
                Swal.fire({
                    icon: 'success',
                    title: 'تم إنشاء حسابك بنجاح!',
                    text: 'يمكنك الآن تسجيل الدخول.',
                    confirmButtonText: 'موافق'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";  // إعادة التوجيه إلى صفحة تسجيل الدخول
                    }
                });
            }
        });
    </script>

</body>

</html>
