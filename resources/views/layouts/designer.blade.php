<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المصمم | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --primary-dark: #5649c0;
            --secondary-color: #a29bfe;
            --dark-color: #2d3436;
            --light-color: #f5f6fa;
            --sidebar-width: 280px;
            --transition-speed: 0.3s;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --card-radius: 12px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Tajawal', sans-serif;
            color: #444;
            overflow-x: hidden;
        }

        /* الشريط الجانبي */
        .designer-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(160deg, var(--primary-color), var(--primary-dark));
            color: white;
            height: 100vh;
            position: fixed;
            padding: 0;
            box-shadow: var(--shadow);
            transition: all var(--transition-speed);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            margin-bottom: 10px;
            background-color: rgba(0,0,0,0.05);
        }

        .sidebar-header h4 {
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-header i {
            margin-left: 10px;
            font-size: 1.2em;
        }

        .sidebar-menu {
            padding: 0 15px;
            height: calc(100vh - 100px);
            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background-color: rgba(255,255,255,0.3);
            border-radius: 10px;
        }

        .sidebar-menu li {
            padding: 8px 0;
            position: relative;
            transition: all var(--transition-speed);
        }

        .sidebar-menu li:after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        }

        .sidebar-menu li:last-child:after {
            display: none;
        }

        .sidebar-menu a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all var(--transition-speed);
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .sidebar-menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(-5px);
        }

        .sidebar-menu i {
            margin-left: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1em;
        }

        /* المحتوى الرئيسي */
        .main-content {
            margin-right: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
            transition: all var(--transition-speed);
            background-color: #f5f7fa;
        }

        /* الكروت */
        .designer-card {
            border-radius: var(--card-radius);
            box-shadow: var(--shadow);
            transition: all var(--transition-speed);
            border: none;
            margin-bottom: 25px;
            overflow: hidden;
            background-color: white;
        }

        .designer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 700;
            border-radius: var(--card-radius) var(--card-radius) 0 0 !important;
            padding: 15px 20px;
            color: var(--dark-color);
        }

        .card-body {
            padding: 20px;
        }

        /* العناصر النشطة */
        .active-menu-item {
            background-color: rgba(255, 255, 255, 0.15) !important;
            color: white !important;
            font-weight: 600;
        }

        /* القوائم المنسدلة */
        .dropdown-menu {
            background-color: rgba(108, 92, 231, 0.95);
            border: none;
            border-radius: var(--card-radius);
            margin-right: 10px;
            padding: 5px 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .dropdown-item {
            color: rgba(255,255,255,0.9);
            padding: 8px 20px;
            font-size: 14px;
            transition: all var(--transition-speed);
            border-radius: 5px;
            margin: 3px 10px;
            width: auto;
        }

        .dropdown-item:hover, .dropdown-item:focus {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .dropdown-toggle::after {
            margin-right: 8px;
            vertical-align: 0.15em;
            transition: transform var(--transition-speed);
        }

        .dropdown.show .dropdown-toggle::after {
            transform: rotate(-180deg);
        }

        /* زر تسجيل الخروج */
        .logout-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.8) !important;
            width: 100%;
            text-align: right;
            padding: 10px 15px !important;
        }

        .logout-btn:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* تأثيرات إضافية */
        .badge-primary {
            background-color: var(--primary-color);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* شريط البحث */
        .search-bar {
            position: relative;
            margin-bottom: 25px;
        }

        .search-bar input {
            padding-right: 45px;
            border-radius: 30px;
            border: 1px solid #e0e0e0;
            box-shadow: none;
        }

        .search-bar i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        /* رسومات متحركة */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animated-card {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* تصميم متجاوب */
        @media (max-width: 992px) {
            .designer-sidebar {
                transform: translateX(calc(var(--sidebar-width) * -1));
            }

            .sidebar-open .designer-sidebar {
                transform: translateX(0);
            }

            .main-content {
                margin-right: 0;
            }

            .sidebar-toggle {
                display: block !important;
            }
        }

        /* زر تبديل الشريط الجانبي */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1050;
            background-color: var(--primary-color);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- زر تبديل الشريط الجانبي (للأجهزة الصغيرة) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- الشريط الجانبي -->
    <div class="designer-sidebar">
        <div class="sidebar-header text-center">
            <h4><i class="fas fa-palette"></i> لوحة المصمم</h4>
        </div>
        <ul class="sidebar-menu list-unstyled">
            <li><a href="{{ route('designer.dashboard') }}" class="{{ request()->is('designer/dashboard') ? 'active-menu-item' : '' }}"><i class="fas fa-home"></i> الرئيسية</a></li>

            <!-- عنصر "عن الجمعية" مع القائمة المنسدلة -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle {{ request()->is('designer/about*') ? 'active-menu-item' : '' }}" data-bs-toggle="dropdown">
                    <i class="fas fa-info-circle"></i> عن الجمعية
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('designer.timeline.index') }}" class="dropdown-item {{ request()->is('designer/timeline*') ? 'active-menu-item' : '' }}"><i class="fas fa-stream"></i> الجدول الزمني</a></li>
                    <li><a href="#" class="dropdown-item"><i class="fas fa-history"></i> تاريخ الجمعية</a></li>
                    <li><a href="#" class="dropdown-item"><i class="fas fa-bullseye"></i> أهداف الجمعية</a></li>
                    <li><a href="{{ route('designer.team.index') }}" class="dropdown-item"><i class="fas fa-users"></i> أعضاء الجمعية</a></li>
                </ul>
            </li>

            {{-- <li><a href="#" class="{{ request()->is('designer/projects*') ? 'active-menu-item' : '' }}"><i class="fas fa-paint-brush"></i> المشاريع <span class="badge bg-white text-primary ms-2">3</span></a></li>
            <li><a href="#" class="{{ request()->is('designer/portfolio*') ? 'active-menu-item' : '' }}"><i class="fas fa-briefcase"></i> المحفظة</a></li>
            <li><a href="#" class="{{ request()->is('designer/clients*') ? 'active-menu-item' : '' }}"><i class="fas fa-users"></i> العملاء <span class="badge bg-white text-primary ms-2">12</span></a></li>
            <li><a href="#" class="{{ request()->is('designer/calendar*') ? 'active-menu-item' : '' }}"><i class="fas fa-calendar-alt"></i> المواعيد</a></li>
            <li><a href="#" class="{{ request()->is('designer/settings*') ? 'active-menu-item' : '' }}"><i class="fas fa-cog"></i> الإعدادات</a></li> --}}
            <li class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn logout-btn text-start w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- المحتوى الرئيسي -->
    <div class="main-content">
        <!-- شريط البحث والعنوان -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">@yield('page-title', 'الرئيسية')</h3>
            <div class="search-bar" style="width: 300px;">
                <input type="text" class="form-control" placeholder="ابحث هنا...">
                <i class="fas fa-search"></i>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // تبديل الشريط الجانبي على الأجهزة الصغيرة
            const sidebarToggle = document.getElementById('sidebarToggle');
            sidebarToggle.addEventListener('click', function() {
                document.body.classList.toggle('sidebar-open');
            });

            // إضافة تأثير للنقر على عناصر القائمة الرئيسية
            const menuItems = document.querySelectorAll('.sidebar-menu > li > a:not(.dropdown-toggle)');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    menuItems.forEach(i => i.classList.remove('active-menu-item'));
                    this.classList.add('active-menu-item');
                });
            });

            // إضافة تأثير للعناصر المنسدلة
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    dropdownItems.forEach(i => i.classList.remove('active-menu-item'));
                    this.classList.add('active-menu-item');

                    // إضافة active للعنصر الأب
                    const parentDropdown = this.closest('.dropdown').querySelector('.dropdown-toggle');
                    parentDropdown.classList.add('active-menu-item');
                });
            });

            // إضافة تأثيرات للكروت عند التحميل
            const cards = document.querySelectorAll('.designer-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.classList.add('animated-card');
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
