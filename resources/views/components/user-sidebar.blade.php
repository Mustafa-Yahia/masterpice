<div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
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

</style>
