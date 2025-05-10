<!-- resources/views/components/designer-sidebar.blade.php -->
<div class="designer-sidebar">
    <div class="sidebar-header">
        <h3>لوحة المصمم</h3>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{ route('designer.dashboard') }}">الرئيسية</a></li>
        <li><a href="{{ route('designer.teams.index') }}">فريق العمل</a></li>
        <li><a href="{{ route('designer.profile') }}">الملف الشخصي</a></li>
        <!-- يمكنك إضافة المزيد من العناصر هنا -->
    </ul>
</div>

<style>
    .designer-sidebar {
        width: 250px;
        background: #2c3e50;
        color: white;
        height: 100vh;
        position: fixed;
        padding: 20px;
    }
    .sidebar-menu li {
        padding: 10px 0;
    }
    .sidebar-menu a {
        color: white;
        text-decoration: none;
    }
</style>
