@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="container">
        <div class="row">
            <!-- Main Content Column - Left Side -->
            <div class="col-lg-8">
                <!-- Profile Card -->
                <div class="profile-card card shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h3 class="mb-0 text-end">
                            <i class="fas fa-user-cog ms-2 text-primary"></i> إدارة الملف الشخصي
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <!-- Personal Info Section -->
                        <div class="profile-section mb-5">
                            <div class="section-header d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0 text-end">
                                    <i class="fas fa-id-card ms-2 text-primary"></i> المعلومات الشخصية
                                </h4>
                                <button class="btn btn-sm btn-outline-primary edit-profile-btn">
                                    <i class="fas fa-edit ms-1"></i> تعديل
                                </button>
                            </div>

                            <div class="profile-info">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="info-item text-end">
                                            <label class="text-muted small d-block">الاسم الكامل</label>
                                            <p class="mb-0">{{ Auth::user()->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item text-end">
                                            <label class="text-muted small d-block">البريد الإلكتروني</label>
                                            <p class="mb-0">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item text-end">
                                            <label class="text-muted small d-block">رقم الهاتف</label>
                                            <p class="mb-0">{{ Auth::user()->phone ?? 'غير مضبوط' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item text-end">
                                            <label class="text-muted small d-block">تاريخ التسجيل</label>
                                            <p class="mb-0">{{ Auth::user()->created_at->format('Y/m/d') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Profile Form (Hidden by Default) -->
                            <div class="edit-profile-form mt-4" style="display: none;">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group text-end">
                                                <label for="name" class="d-block">الاسم الكامل</label>
                                                <input type="text" name="name" id="name"
                                                       class="form-control text-end"
                                                       value="{{ Auth::user()->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group text-end">
                                                <label for="email" class="d-block">البريد الإلكتروني</label>
                                                <input type="email" name="email" id="email"
                                                       class="form-control text-end"
                                                       value="{{ Auth::user()->email }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group text-end">
                                                <label for="phone" class="d-block">رقم الهاتف</label>
                                                <input type="tel" name="phone" id="phone"
                                                       class="form-control text-end"
                                                       value="{{ Auth::user()->phone }}"/>
                                            </div>
                                        </div>
                                        <!-- تم إزالة حقل صورة الملف الشخصي -->
                                    </div>
                                    <div class="d-flex justify-content-start mt-3">
                                        <button type="submit" class="btn btn-primary me-2">
                                            حفظ التغييرات
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary cancel-edit-btn">
                                            إلغاء
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Change Password Section -->
                        <div class="profile-section">
                            <div class="section-header mb-4">
                                <h4 class="mb-0 text-end">
                                    <i class="fas fa-lock ms-2 text-primary"></i> تغيير كلمة المرور
                                </h4>
                            </div>

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group text-end">
                                            <label for="current_password" class="d-block">كلمة المرور الحالية</label>
                                            <div class="input-group">
                                                <input type="password" name="current_password" id="current_password"
                                                       class="form-control text-end" required>
                                                <span class="input-group-text toggle-password" data-target="current_password">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            <div id="current-password-status" class="small mt-1 text-end"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-end">
                                            <label for="new_password" class="d-block">كلمة المرور الجديدة</label>
                                            <div class="input-group">
                                                <input type="password" name="new_password" id="new_password"
                                                       class="form-control text-end" required>
                                                <span class="input-group-text toggle-password" data-target="new_password">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            <div id="new-password-status" class="small mt-1 text-end"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-end">
                                            <label for="new_password_confirmation" class="d-block">تأكيد كلمة المرور الجديدة</label>
                                            <div class="input-group">
                                                <input type="password" name="new_password_confirmation"
                                                       id="new_password_confirmation"
                                                       class="form-control text-end" required>
                                                <span class="input-group-text toggle-password" data-target="new_password_confirmation">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            <div id="confirm-password-status" class="small mt-1 text-end"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        تغيير كلمة المرور
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column - Right Side -->
            @include('components.user-sidebar')
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>

    .profile-container{
    position: relative;
    padding: 120px 0px 80px;
    }
    /* Form Styles */
    .form-group label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #495057;
        display: block;
        text-align: right;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s ease;
        text-align: right;
    }

    .form-control:focus {
        border-color: #3cc88f;
        box-shadow: 0 0 0 0.2rem rgba(60, 200, 143, 0.25);
    }

    /* Buttons */
    .btn-primary {
        background-color: #3cc88f;
        border-color: #3cc88f;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2da578;
        border-color: #2da578;
    }

    .btn-outline-primary {
        color: #3cc88f;
        border-color: #3cc88f;
    }

    .btn-outline-primary:hover {
        background-color: #3cc88f;
        color: #fff;
    }

    /* Password Status */
    .weak {
        text-align: right;
        color: #dc3545;
    }

    .medium {
        text-align: right;
        color: #fd7e14;
    }

    .strong {
        text-align: right;
        color: #28a745;
    }

    /* Toggle Password */
    .toggle-password {
        cursor: pointer;
        background-color: #f8f9fa;
        border-left: none;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .profile-sidebar {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 767.98px) {
        .profile-info .col-md-6 {
            margin-bottom: 15px;
        }
    }
</style>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit Profile Toggle
        const editProfileBtn = document.querySelector('.edit-profile-btn');
        const cancelEditBtn = document.querySelector('.cancel-edit-btn');
        const profileInfo = document.querySelector('.profile-info');
        const editProfileForm = document.querySelector('.edit-profile-form');

        if (editProfileBtn && cancelEditBtn) {
            editProfileBtn.addEventListener('click', function() {
                profileInfo.style.display = 'none';
                editProfileForm.style.display = 'block';
                this.style.display = 'none';
            });

            cancelEditBtn.addEventListener('click', function() {
                profileInfo.style.display = 'block';
                editProfileForm.style.display = 'none';
                editProfileBtn.style.display = 'inline-block';
            });
        }

        // Toggle Password Visibility
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Password Strength Check
        $('#new_password').on('input', function() {
            const password = $(this).val();

            if (password.length === 0) {
                $('#new-password-status').text('').removeClass();
                return;
            }

            $.ajax({
                url: "{{ route('password.checkStrength') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    password: password
                },
                success: function(response) {
                    $('#new-password-status').text(response.strength_message)
                                             .removeClass()
                                             .addClass(response.strength_class);
                }
            });
        });

        // Current Password Check
        $('#current_password').on('input', function() {
            const currentPassword = $(this).val();

            if (currentPassword.length === 0) {
                $('#current-password-status').text('').removeClass();
                return;
            }

            $.ajax({
                url: "{{ route('password.checkCurrentPassword') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    current_password: currentPassword
                },
                success: function(response) {
                    $('#current-password-status').text(response.message)
                                                .removeClass()
                                                .addClass(response.class);
                }
            });
        });

        // Confirm Password Check
        $('#new_password_confirmation').on('input', function() {
            const newPassword = $('#new_password').val();
            const confirmPassword = $(this).val();

            if (confirmPassword.length === 0) {
                $('#confirm-password-status').text('').removeClass();
                return;
            }

            if (newPassword === confirmPassword) {
                $('#confirm-password-status').text('كلمة المرور متطابقة')
                                            .removeClass()
                                            .addClass('strong');
            } else {
                $('#confirm-password-status').text('كلمة المرور غير متطابقة')
                                            .removeClass()
                                            .addClass('weak');
            }
        });
    });
</script>

<!-- SweetAlert Notifications -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'تم بنجاح!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if($errors->any()))
<script>
    Swal.fire({
        icon: 'error',
        title: 'خطأ!',
        text: '{{ $errors->first() }}',
        timer: 3000
    });
</script>
@endif
@endsection
