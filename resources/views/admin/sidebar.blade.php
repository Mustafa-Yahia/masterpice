<!-- Modern Admin Sidebar -->
<div class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <div class="logo-container">
            <i class="fas fa-shield-alt logo-icon"></i>
            <h2 class="logo-text">لوحة التحكم</h2>
        </div>
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="sidebar-menu">
        <ul class="menu-items">
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" class="menu-link active">
                    <span class="menu-icon"><i class="fas fa-home"></i></span>
                    <span class="menu-title">الرئيسية</span>
                    <span class="menu-badge"></span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-users"></i></span>
                    <span class="menu-title">إدارة المستخدمين</span>
                    <span class="menu-badge">5 جديد</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.causes.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-hand-holding-heart"></i></span>
                    <span class="menu-title">إدارة الحملات</span>
                    <span class="menu-badge">3 نشطة</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.events.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-calendar-alt"></i></span>
                    <span class="menu-title">إدارة الأحداث</span>
                    <span class="menu-badge">2 قريبًا</span>
                </a>
            </li>
            <li class="menu-item has-submenu">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-chart-line"></i></span>
                    <span class="menu-title">التقارير</span>
                    <span class="menu-arrow"><i class="fas fa-angle-down"></i></span>
                </a>
                <ul class="submenu">
                    <li><a href="#">تقارير المستخدمين</a></li>
                    <li><a href="#">تقارير التبرعات</a></li>
                    <li><a href="#">تحليل الزيارات</a></li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-cogs"></i></span>
                    <span class="menu-title">الإعدادات</span>
                    <span class="menu-badge"></span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>تسجيل الخروج</span>
            </button>
        </form>
        <div class="user-profile">
            <div class="avatar">
                <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" alt="Admin">
            </div>
            <div class="user-info">
                <span class="user-name">الإدارة</span>
                <span class="user-role">مدير النظام</span>
            </div>
        </div>
    </div>
</div>
{{-- <!-- Sidebar -->
<div class="sidebar" style="width: 250px; background: #2c3e50; height: 100vh; position: fixed; right: 0; top: 0; padding: 20px; color: white; text-align: right;">
    <h2 style="color: #ecf0f1;">لوحة التحكم</h2>
    <ul style="list-style: none; padding: 0; margin-top: 30px;">
        <li style="margin-bottom: 20px;">
            <a href="{{ route('admin.dashboard') }}" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-home" style="margin-left: 10px;"></i> الرئيسية
            </a>
        </li>
        <li style="margin-bottom: 20px;">
            <a href="{{ route('admin.users.index') }}" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-users" style="margin-left: 10px;"></i> إدارة المستخدمين
            </a>
        </li>
        <li style="margin-bottom: 20px;">
            <a href="{{ route('admin.causes.index') }}" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-hand-holding-heart" style="margin-left: 10px;"></i> إدارة الحملات
            </a>
        </li>
        <li style="margin-bottom: 20px;">
            <a href="{{ route('admin.events.index') }}" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-calendar-alt" style="margin-left: 10px;"></i> إدارة الأحداث
            </a>
        </li>
        <li style="margin-bottom: 20px;">
            <a href="" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-cogs" style="margin-left: 10px;"></i> الإعدادات
            </a>
        </li>
        <li style="margin-top: 40px;">
            <form method="POST" action="{{ route('logout') }}" style="display: flex; justify-content: center; align-items: center;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #e74c3c; text-decoration: none; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center;">
                    <i class="fas fa-sign-out-alt" style="margin-left: 10px;"></i> تسجيل الخروج
                </button>
            </form>
        </li>
    </ul>
</div> --}}


{{-- <div class="sidebar" style="width: 250px; background: #2c3e50; height: 100vh; position: fixed; right: 0; top: 0; padding: 20px; color: white; text-align: right;">
    <h2 style="color: #ecf0f1;">لوحة التحكم</h2>
    <ul style="list-style: none; padding: 0; margin-top: 30px;">
        <li style="margin-bottom: 20px;">
            <a href="{{ route('admin.dashboard') }}" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-home" style="margin-left: 10px;"></i> الرئيسية
            </a>
        </li>
        <li style="margin-bottom: 20px;">
            <a href="{{ route('admin.users.index') }}" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-users" style="margin-left: 10px;"></i> إدارة المستخدمين
            </a>
        </li>
        <li style="margin-bottom: 20px;">
            <a href="{{ route('admin.causes.index') }}" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-hand-holding-heart" style="margin-left: 10px;"></i> إدارة الحملات
            </a>
        </li>

        <li style="margin-bottom: 20px;">
            <a href="" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-calendar-alt" style="margin-left: 10px;"></i> إدارة الأحداث
            </a>
        </li>
        <li style="margin-bottom: 20px;">
            <a href="" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-cogs" style="margin-left: 10px;"></i> الإعدادات
            </a>
        </li>
        <li style="margin-top: 40px;">
            <form method="POST" action="{{ route('logout') }}" style="display: flex; justify-content: center; align-items: center;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #e74c3c; text-decoration: none; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center;">
                    <i class="fas fa-sign-out-alt" style="margin-left: 10px;"></i> تسجيل الخروج
                </button>
            </form>
        </li>
    </ul>
</div> --}}
