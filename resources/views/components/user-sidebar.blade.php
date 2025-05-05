<!-- Sidebar Column - Right Side -->
<div class="col-lg-4">
    <div class="profile-sidebar card shadow-sm border-0 rounded-4 overflow-hidden">
        <!-- User Info Card -->
        <div class="user-info-card text-center p-4 bg-primary text-white">
            <!-- إزالة الجزء الخاص بالصورة -->
            <!-- <div class="user-avatar mb-3">
                <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.png') }}"
                     class="rounded-circle border border-4 border-white"
                     width="120" height="120"
                     alt="صورة المستخدم">
            </div> -->
            <h4 class="mb-1">{{ Auth::user()->name }}</h4>
            <p class="small mb-3">{{ Auth::user()->email }}</p>
            <div class="user-status-badge bg-white text-primary rounded-pill px-3 py-1 d-inline-block">
                <i class="fas fa-circle-check ms-1"></i> عضو نشط
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="profile-menu p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile.index' ? 'active' : '' }}"
                       href="{{ route('profile.index') }}">
                        <i class="fas fa-user-circle ms-2"></i> الملف الشخصي
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile.donations' ? 'active' : '' }}"
                       href="{{ route('profile.donations') }}">
                        <i class="fas fa-donate ms-2"></i> التبرعات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile.subscriptions' ? 'active' : '' }}"
                       href="{{ route('profile.subscriptions') }}">
                        <i class="fas fa-handshake ms-2"></i> طلبات التطوع
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog ms-2"></i> الإعدادات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt ms-2"></i> تسجيل الخروج
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
     /* Profile Sidebar */
     .profile-sidebar {
        position: sticky;
        top: 20px;
    }

    .user-info-card {
        border-radius: 12px 12px 0 0;
        position: relative;
        overflow: hidden;
    }

    .user-info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(60, 200, 143, 0.9), rgba(32, 168, 111, 0.9));
        z-index: 1;
    }

    .user-avatar,
    .user-info-card h4,
    .user-info-card p,
    .user-status-badge {
        position: relative;
        z-index: 2;
    }

    .user-avatar img {
        object-fit: cover;
    }

    .user-status-badge {
        font-size: 13px;
    }

    /* Profile Menu */
    .profile-menu .nav-link {
        padding: 12px 15px;
        color: #495057;
        border-radius: 8px;
        margin-bottom: 5px;
        transition: all 0.3s ease;
        font-weight: 500;
        text-align: right;
    }

    .profile-menu .nav-link:hover,
    .profile-menu .nav-link.active {
        background-color: rgba(60, 200, 143, 0.1);
        color: #3cc88f;
    }

    .profile-menu .nav-link i {
        width: 20px;
        text-align: center;
    }

    /* Profile Card */
    .profile-card {
        border: none;
    }

    .profile-card .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* Profile Sections */
    .profile-section {
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .section-header h4 {
        font-size: 18px;
        font-weight: 600;
        color: #2a2a2a;
    }

    /* Info Items */
    .info-item {
        margin:5px;
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
    }

    .info-item label {
        font-size: 13px;
    }

    .info-item p {
        font-weight: 500;
        margin-top: 5px;
    }

</style>

{{-- <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
    <div class="sidebar" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; background: #fff;">
        <h3 style="font-size: 20px; font-weight: bold; color: #333; text-align:center;">القائمة</h3>
        <ul class="nav flex-column">
            <!-- ملف شخصي -->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile.index' ? 'active' : '' }}" href="{{ route('profile.index') }}" style="font-size: 16px; color: #333;">
                    <i class="fas fa-user-circle" style="margin-left: 5px;"></i> الملف الشخصي
                </a>
            </li>

            <!-- التبرعات -->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile.donations' ? 'active' : '' }}" href="{{ route('profile.donations') }}" style="font-size: 16px; color: #333;">
                    <i class="fas fa-donate" style="margin-left: 5px;"></i> التبرعات
                </a>
            </li>

            <!-- طلبات الاشتراك في التطوع -->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile.subscriptions' ? 'active' : '' }}" href="{{ route('profile.subscriptions') }}" style="font-size: 16px; color: #333;">
                    <i class="fas fa-handshake" style="margin-left: 5px;"></i> طلبات الاشتراك في التطوع
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    .nav-link.active {
    background-color: #3cc88f;  /* إضافة خلفية خضراء أو اللون الذي تفضله */
    color: #fff;  /* تغيير اللون النصي */
    font-weight: bold;  /* تكبير الخط */
}

</style> --}}
