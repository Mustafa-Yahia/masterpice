@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-user-edit"></i> تعديل مستخدم
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">المستخدمين</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تعديل</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Alerts -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Edit User Form -->
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- الاسم الكامل -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">الاسم الكامل</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                        </div>

                        <!-- الدور -->
                        <div class="col-md-6">
                            <label for="role" class="form-label">الدور</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="donor" {{ old('role', $user->role) == 'donor' ? 'selected' : '' }}>متبرع</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>مشرف</option>
                            </select>
                        </div>
                        <!-- كلمة المرور -->
                        <div class="col-md-6">
                            <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">اترك الحقل فارغًا إذا كنت لا تريد تغيير كلمة المرور</small>
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- أزرار الحفظ والإلغاء -->
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // إظهار/إخفاء كلمة المرور
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
</script>
@endpush
{{-- @extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding-right: 270px; padding-top: 20px; direction: rtl;">
    @include('admin.sidebar')

    <div class="content" style="background: #f9f9f9; padding: 30px; min-height: 100vh; direction: rtl;">
        <h1>تعديل المستخدم</h1>

        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-top: 20px;">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                </div>

                <div class="form-group">
                    <label>الدور</label>
                    <input type="text" name="role" class="form-control" value="{{ $user->role }}" required>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">تحديث</button>
            </form>
        </div>
    </div>
</div>
@endsection --}}
