@extends('layouts.admin')

@section('content')
<div class="admin-container" style="min-height: 100vh;">
    @include('admin.sidebar')

    <div class="admin-content" style="background-color: rgba(255, 255, 255, 0.95); border-radius: 15px; margin: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
        <!-- Header Section -->
        <div class="content-header" style="padding: 20px; border-bottom: 1px solid #eaeaea;">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title" style="color: #2c3e50; font-weight: 700;">
                    <i class="fas fa-user-edit" style="color: #3cc88f;"></i> تعديل مستخدم
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #2c3e50;">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}" style="color: #2c3e50;">المستخدمين</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #3cc88f;">تعديل</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Alerts -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 20px; border-radius: 10px; border-left: 5px solid #e74c3c;">
            <i class="fas fa-exclamation-circle me-2"></i>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 20px; border-radius: 10px; border-left: 5px solid #3cc88f;">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Edit User Form -->
        <div class="card shadow-sm" style="border: none; border-radius: 10px; margin: 20px;">
            <div class="card-body" style="padding: 30px;">
                <form id="editUserForm" action="{{ route('admin.users.update', $user->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- الاسم الكامل -->
                        <div class="col-md-6">
                            <label for="name" class="form-label" style="color: #2c3e50; font-weight: 600;">الاسم الكامل</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #f8f9fa; border-color: #ddd;">
                                    <i class="fas fa-user" style="color: #3cc88f;"></i>
                                </span>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $user->name) }}" required
                                       style="border-color: #ddd; border-radius: 0 5px 5px 0;"
                                       pattern="^[\u0600-\u06FF\s]{3,}(?:\s[\u0600-\u06FF\s]{3,}){2}$"
                                       title="يجب أن يتكون الاسم من ثلاثة مقاطع (مثال: أحمد محمد عبدالله)">
                                <div class="invalid-feedback">يجب أن يتكون الاسم من ثلاثة مقاطع (مثال: أحمد محمد عبدالله)</div>
                            </div>
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="col-md-6">
                            <label for="email" class="form-label" style="color: #2c3e50; font-weight: 600;">البريد الإلكتروني</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #f8f9fa; border-color: #ddd;"><i class="fas fa-envelope" style="color: #3cc88f;"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                    style="border-color: #ddd; border-radius: 0 5px 5px 0;"
                                    oninput="validateEmail(this)">
                                <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح</div>
                            </div>
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label" style="color: #2c3e50; font-weight: 600;">رقم الهاتف</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #f8f9fa; border-color: #ddd;"><i class="fas fa-phone" style="color: #3cc88f;"></i></span>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                    style="border-color: #ddd; border-radius: 0 5px 5px 0;"
                                    pattern="^\+962[0-9]{9}$" oninput="validatePhone(this)"
                                    placeholder="+962780211175">
                                <div class="invalid-feedback">يجب إدخال رقم هاتف صحيح (يبدأ بـ +962 ويتبعه 9 أرقام)</div>
                            </div>
                            <small class="text-muted" style="color: #6c757d;">التنسيق المطلوب: +962XXXXXXXXX</small>
                        </div>
                        <!-- الدور -->
                        <div class="col-md-6">
                            <label for="role" class="form-label" style="color: #2c3e50; font-weight: 600;">نوع المستخدم</label>
                            <select class="form-select" id="role" name="role" required
                                style="border-color: #ddd;"
                                onchange="validateField(this, 'نوع المستخدم مطلوب')">
                                <option value="">اختر نوع المستخدم</option>
                                <option value="donor" {{ old('role', $user->role) == 'donor' ? 'selected' : '' }}>متبرع</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>مشرف</option>
                            </select>
                            <div class="invalid-feedback">نوع المستخدم مطلوب</div>
                        </div>

                        <!-- كلمة المرور -->
                        <div class="col-md-6">
                            <label for="password" class="form-label" style="color: #2c3e50; font-weight: 600;">كلمة المرور الجديدة (اختياري)</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #f8f9fa; border-color: #ddd;"><i class="fas fa-lock" style="color: #3cc88f;"></i></span>
                                <input type="password" class="form-control" id="password" name="password"
                                    style="border-color: #ddd; border-radius: 0 5px 5px 0;"
                                    pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" oninput="validatePassword(this)">
                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    style="border-color: #ddd; border-radius: 0 5px 5px 0;">
                                    <i class="fas fa-eye" style="color: #3cc88f;"></i>
                                </button>
                            </div>
                            <small class="text-muted" style="color: #6c757d;">يجب أن تحتوي على الأقل على 8 أحرف، حرف ورقم</small>
                            <div class="invalid-feedback">يجب أن تحتوي كلمة المرور على الأقل على 8 أحرف، حرف ورقم</div>
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label" style="color: #2c3e50; font-weight: 600;">تأكيد كلمة المرور</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #f8f9fa; border-color: #ddd;"><i class="fas fa-lock" style="color: #3cc88f;"></i></span>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                    style="border-color: #ddd; border-radius: 0 5px 5px 0;"
                                    oninput="validatePasswordConfirmation(this)">
                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    style="border-color: #ddd; border-radius: 0 5px 5px 0;">
                                    <i class="fas fa-eye" style="color: #3cc88f;"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">كلمة المرور غير متطابقة</div>
                        </div>
                    </div>

                    <!-- أزرار الحفظ والإلغاء -->
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"
                            style="border-color: #ddd; color: #2c3e50; padding: 10px 20px; border-radius: 5px;">
                            <i class="fas fa-times me-1"></i> إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary"
                            style="background-color: #3cc88f; border: none; padding: 10px 20px; border-radius: 5px; font-weight: 600;">
                            <i class="fas fa-save me-1"></i> حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .admin-container {
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3cc88f;
        box-shadow: 0 0 0 0.25rem rgba(60, 200, 143, 0.25);
    }

    .btn-primary:hover {
        background-color: #2fa578 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(60, 200, 143, 0.4);
    }

    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        color: #2c3e50 !important;
    }

    .input-group-text {
        transition: all 0.3s ease;
    }

    .toggle-password:hover {
        background-color: #f8f9fa;
    }

    .is-invalid {
        border-color: #e74c3c !important;
    }

    .is-valid {
        border-color: #3cc88f !important;
    }

    .invalid-feedback {
        color: #e74c3c;
        font-size: 0.875em;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // التحقق من الاسم قبل الإرسال
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const nameInput = document.getElementById('name');
                const nameValue = nameInput.value.trim();
                const segments = nameValue.split(/\s+/);

                if (segments.length < 3) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'خطأ في الاسم',
                        text: 'يجب أن يتكون الاسم من ثلاثة مقاطع (مثال: أحمد محمد عبدالله)',
                        icon: 'error',
                        confirmButtonColor: '#3cc88f',
                        customClass: {
                            popup: 'text-right'
                        }
                    });
                    return;
                }

                for (const segment of segments) {
                    if (segment.length < 3) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'خطأ في الاسم',
                            text: 'يجب أن يحتوي كل مقطع من الاسم على 3 أحرف على الأقل',
                            icon: 'error',
                            confirmButtonColor: '#3cc88f',
                            customClass: {
                                popup: 'text-right'
                            }
                        });
                        return;
                    }
                }
            });
        }
    });
    </script>
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

    // التحقق من النموذج قبل الإرسال
    const form = document.getElementById('editUserForm');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();

            // التحقق من جميع الحقول
            validateField(document.getElementById('name'), 'الاسم الكامل مطلوب');
            validateEmail(document.getElementById('email'));
            validatePhone(document.getElementById('phone'));
            validateField(document.getElementById('role'), 'نوع المستخدم مطلوب');

            if (document.getElementById('password').value) {
                validatePassword(document.getElementById('password'));
                validatePasswordConfirmation(document.getElementById('password_confirmation'));
            }
        }

        form.classList.add('was-validated');
    }, false);
});

// دالة للتحقق من الحقول النصية
function validateField(field, errorMessage) {
    const feedback = field.nextElementSibling;
    if (field.value.trim() === '') {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        if (feedback) feedback.textContent = errorMessage;
        return false;
    } else {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        return true;
    }
}

// دالة للتحقق من البريد الإلكتروني
function validateEmail(emailField) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const feedback = emailField.nextElementSibling;

    if (!emailRegex.test(emailField.value)) {
        emailField.classList.add('is-invalid');
        emailField.classList.remove('is-valid');
        if (feedback) feedback.textContent = 'يرجى إدخال بريد إلكتروني صحيح';
        return false;
    } else {
        emailField.classList.remove('is-invalid');
        emailField.classList.add('is-valid');
        return true;
    }
}

// دالة للتحقق من رقم الهاتف
function validatePhone(phoneField) {
    const phoneRegex = /^\+962[0-9]{9}$/;
    const feedback = phoneField.nextElementSibling;

    if (phoneField.value && !phoneRegex.test(phoneField.value)) {
        phoneField.classList.add('is-invalid');
        phoneField.classList.remove('is-valid');
        if (feedback) feedback.textContent = 'يجب إدخال رقم هاتف صحيح (يبدأ بـ +962 ويتبعه 9 أرقام)';
        return false;
    } else {
        phoneField.classList.remove('is-invalid');
        if (phoneField.value) phoneField.classList.add('is-valid');
        return true;
    }
}

// دالة للتحقق من كلمة المرور
function validatePassword(passwordField) {
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    const feedback = passwordField.parentNode.parentNode.querySelector('.invalid-feedback');

    if (passwordField.value && !passwordRegex.test(passwordField.value)) {
        passwordField.classList.add('is-invalid');
        passwordField.classList.remove('is-valid');
        if (feedback) feedback.style.display = 'block';
        return false;
    } else {
        passwordField.classList.remove('is-invalid');
        if (passwordField.value) passwordField.classList.add('is-valid');
        if (feedback && passwordField.value === '') feedback.style.display = 'none';
        return true;
    }
}

// دالة للتحقق من تطابق كلمة المرور
function validatePasswordConfirmation(confirmationField) {
    const passwordField = document.getElementById('password');
    const feedback = confirmationField.parentNode.parentNode.querySelector('.invalid-feedback');

    if (confirmationField.value !== passwordField.value) {
        confirmationField.classList.add('is-invalid');
        confirmationField.classList.remove('is-valid');
        if (feedback) feedback.style.display = 'block';
        return false;
    } else {
        confirmationField.classList.remove('is-invalid');
        if (confirmationField.value) confirmationField.classList.add('is-valid');
        if (feedback && confirmationField.value === '') feedback.style.display = 'none';
        return true;
    }
}
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
