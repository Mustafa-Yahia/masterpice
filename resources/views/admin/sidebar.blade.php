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
                    <span class="menu-badge">{{$totalUsers ?? 0}}مسخدمين</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.causes.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-hand-holding-heart"></i></span>
                    <span class="menu-title">إدارة الحملات</span>
        <span class="menu-badge">{{ $activeCauses ?? 0 }} نشطة</span>
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
                <img src="https://ui-avatars.com/api/?name=Admin&background=3cc88f&color=fff" alt="Admin">
            </div>
            <div class="user-info">
                <span class="user-name">الإدارة</span>
                <span class="user-role">مدير النظام</span>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --sidebar-color: #3cc88f;
    --sidebar-dark: #34b181;
    --sidebar-light: #4ad49a;
    --sidebar-text: #ffffff;
    --sidebar-hover: #2a9d70;
}

.admin-sidebar {
    background-color: var(--sidebar-color);
    color: var(--sidebar-text);
    transition: all 0.3s ease;
    height: 100vh;
    position: fixed;
    width: 280px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    padding: 20px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: var(--sidebar-dark);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo-icon {
    font-size: 24px;
    color: var(--sidebar-text);
}

.logo-text {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
    color: var(--sidebar-text);
}

.sidebar-toggle {
    background: transparent;
    border: none;
    color: var(--sidebar-text);
    font-size: 18px;
    cursor: pointer;
    padding: 5px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.sidebar-toggle:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.sidebar-menu {
    flex: 1;
    overflow-y: auto;
    padding: 15px 0;
}

.menu-items {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu-item {
    position: relative;
}

.menu-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: var(--sidebar-text);
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.menu-link:hover {
    background-color: var(--sidebar-hover);
}

.menu-link.active {
    background-color: var(--sidebar-dark);
    border-left: 4px solid var(--sidebar-text);
}

.menu-icon {
    margin-left: 10px;
    font-size: 16px;
    width: 20px;
    text-align: center;
}

.menu-title {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
}

.menu-badge {
    background-color: rgba(255, 255, 255, 0.2);
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 500;
}

.menu-arrow {
    transition: transform 0.3s ease;
}

.has-submenu.active .menu-arrow {
    transform: rotate(180deg);
}

.submenu {
    list-style: none;
    padding: 0;
    margin: 0;
    background-color: var(--sidebar-dark);
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.has-submenu.active .submenu {
    max-height: 500px;
}

.submenu li a {
    display: block;
    padding: 10px 20px 10px 50px;
    color: var(--sidebar-text);
    text-decoration: none;
    font-size: 13px;
    transition: all 0.3s ease;
}

.submenu li a:hover {
    background-color: var(--sidebar-hover);
}

.sidebar-footer {
    background-color: var(--sidebar-dark);
    padding: 15px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.logout-btn {
    background-color: transparent;
    border: none;
    color: var(--sidebar-text);
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.logout-btn:hover {
    background-color: var(--sidebar-hover);
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-size: 14px;
    font-weight: 500;
}

.user-role {
    font-size: 12px;
    opacity: 0.8;
}

/* Responsive styles */
@media (max-width: 992px) {
    .admin-sidebar {
        transform: translateX(-100%);
        z-index: 1000;
    }

    .admin-sidebar.active {
        transform: translateX(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const adminSidebar = document.getElementById('adminSidebar');

    if (sidebarToggle && adminSidebar) {
        sidebarToggle.addEventListener('click', function() {
            adminSidebar.classList.toggle('active');
        });
    }

    // Handle submenu toggle
    const submenuItems = document.querySelectorAll('.has-submenu > .menu-link');

    submenuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth > 992) {
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('active');
            }
        });
    });
});
</script>
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
