<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <title>LoveUs - Charity and Fundraising HTML Template | Home Page 01</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cause.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- تحسين الأداء للمتصفحات القديمة -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
        <script src="{{ asset('js/respond.js') }}"></script>
    <![endif]-->
</head>

<body>
    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <div class="scroll-to-top scroll-to-target" data-target="html">
        <span class="flaticon-up-arrow"></span>
    </div>

    <script src="{{ asset('js/jquery.js') }}" defer></script>
    <script src="{{ asset('js/popper.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui.js') }}" defer></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}" defer></script>
    <script src="{{ asset('js/owl.js') }}" defer></script>
    <script src="{{ asset('js/appear.js') }}" defer></script>
    <script src="{{ asset('js/wow.js') }}" defer></script>
    <script src="{{ asset('js/lazyload.js') }}" defer></script>
    <script src="{{ asset('js/scrollbar.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        document.querySelector('.scroll-to-top').addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>

</html>
