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
            <a href="{{ route('admin.donations.index') }}" style="color: #ecf0f1; text-decoration: none; display: flex; justify-content: space-between;">
                <i class="fas fa-hand-holding-heart" style="margin-left: 10px;"></i> إدارة التبرعات
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
</div>
