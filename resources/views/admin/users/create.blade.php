@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-user-plus"></i> إضافة مستخدم جديد
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">المستخدمين</a></li>
                        <li class="breadcrumb-item active" aria-current="page">إضافة جديد</li>
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

        <!-- Create User Form -->
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <!-- الاسم الكامل -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <!-- الدور -->
                        <div class="col-md-6">
                            <label for="role" class="form-label">الدور <span class="text-danger">*</span></label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">اختر الدور</option>
                                <option value="donor" {{ old('role') == 'donor' ? 'selected' : '' }}>مستخدم</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>مشرف</option>
                            </select>
                        </div>

                        <!-- كلمة المرور -->
                        <div class="col-md-6">
                            <label for="password" class="form-label">كلمة المرور <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">يجب أن تتكون كلمة المرور من 8 أحرف على الأقل</small>
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
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
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> حفظ المستخدم
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

    // التحقق من تطابق كلمة المرور
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');

    function validatePassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('كلمة المرور غير متطابقة');
        } else {
            confirmPassword.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirmPassword.onkeyup = validatePassword;
});
</script>
@endpush
{{-- @extends('layouts.admin')

@section('content')
<div class="container" style="padding-right: 270px; padding-top: 20px;">
    @include('admin.sidebar')

    <div class="content">
        <h1>إضافة مستخدم جديد</h1>

        <form action="{{ route('admin.users.store') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>رقم الهاتف</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label>الدور</label>
                <input type="text" name="role" class="form-control" required>
            </div>
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success" style="margin-top: 20px;">إضافة</button>
        </form>
    </div>
</div>
@endsection --}}
