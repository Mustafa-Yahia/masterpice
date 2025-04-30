@extends('layouts.app')

@section('content')

<!-- Sidebar Page Container -->
<div class="sidebar-page-container" style="direction: rtl;">
    <div class="auto-container">
        <div class="row clearfix">

            <!-- Sidebar -->
            <x-user-sidebar :subscriptions="$subscriptions" />

            <!-- Content Side -->
            <div class="content-side col-lg-8 col-md-12 col-sm-12">
                <div class="user-profile-details card" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 30px; border-radius: 10px; background: #fff;">

                    <!-- عرض معلومات المستخدم -->
                    <div class="profile-section mb-4">
                        <h2 style="text-align: center">معلومات المستخدم</h2>
                        <ul>
                            <li><strong>الاسم: </strong>{{ Auth::user()->name }}</li>
                            <li><strong>البريد الإلكتروني: </strong>{{ Auth::user()->email }}</li>
                            <li><strong>رقم الهاتف: </strong>{{ Auth::user()->phone }}</li>
                        </ul>
                    </div>

                    <!-- تعديل معلومات الحساب -->
                    <div class="profile-section mb-4">
                        <h3 style="text-align: center">تعديل معلومات الحساب</h3>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">الاسم:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني:</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">تحديث المعلومات</button>
                        </form>
                    </div>

                    <!-- تغيير كلمة المرور -->
                    <div class="profile-section mb-4">
                        <h3 style="text-align: center">تغيير كلمة المرور</h3>
                        <form method="POST" action="{{ route('password.update') }} ">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="current_password" style="text-align: right;">كلمة المرور الحالية:</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" required>
                                <div id="current-password-status"></div> <!-- لعرض حالة كلمة المرور الحالية -->
                            </div>

                            <div class="form-group">
                                <label for="new_password" style="text-align: right;">كلمة المرور الجديدة:</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" required>
                                <div id="new-password-status"></div> <!-- لعرض حالة كلمة المرور الجديدة -->
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation" style="text-align: right;">تأكيد كلمة المرور الجديدة:</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                                <div id="confirm-password-status"></div> <!-- لعرض حالة التأكيد -->
                            </div>

                            <button type="submit" class="btn btn-primary w-100">تغيير كلمة المرور</button>
                        </form>

                    </div>

                </div>
            </div>

            <!-- Sidebar (Optional) -->
            <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                <div class="sidebar">
                    <!-- يمكن إضافة روابط إضافية أو محتوى آخر هنا -->
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Custom CSS for better design -->
<style>
    /* General styling */
    .profile-section {
        text-align: right;
        direction: ltr;
        margin-bottom: 30px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .profile-section h3 {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-radius: 10px;
        background: #fff;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 5px;
        padding: 12px;
        border: 1px solid #ccc;
        width: 100%;
    }

    .form-control:focus {
        border-color: #3cc88f;
        box-shadow: 0 0 5px rgba(60, 200, 143, 0.5);
    }

    .btn-primary {
        background-color: #3cc88f;
        border-color: #3cc88f;
        display: inline-block;
        padding: 12px 20px;
        border-radius: 5px;
        color: #fff;
        font-weight: bold;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #2fae77;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    button {
        margin-top: 15px;
        text-align: right;
    }

    .w-100 {
        width: 100%;
    }



    #current-password-status {
    margin-top: 5px;
    font-weight: bold;
}

#new-password-status {
    margin-top: 5px;
    font-weight: bold;
}

#confirm-password-status {
    margin-top: 5px;
    font-weight: bold;
}

.weak {
    color: red;
}

.medium {
    color: orange;
}

.strong {
    color: green;
}

</style>

<script>
   $(document).ready(function() {
    $('#current_password').on('input', function() {
        var currentPassword = $(this).val();


        $.ajax({
            url: "{{ route('password.checkCurrentPassword') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                current_password: currentPassword
            },
            success: function(response) {
                $('#current-password-status').html(response.message);
                $('#current-password-status').removeClass().addClass(response.class);
            }
        });
    });

    // تحقق من كلمة المرور الجديدة عند الكتابة
    $('#new_password').on('input', function() {
        var newPassword = $(this).val();

        // تحقق من تطابق كلمة المرور الجديدة مع تأكيد كلمة المرور
        var confirmPassword = $('#new_password_confirmation').val();
        var isMatch = (newPassword === confirmPassword);

        if (isMatch) {
            $('#confirm-password-status').html("كلمة المرور الجديدة متطابقة");
            $('#confirm-password-status').removeClass().addClass('strong');
        } else {
            $('#confirm-password-status').html("كلمة المرور الجديدة غير متطابقة");
            $('#confirm-password-status').removeClass().addClass('weak');
        }

        // إرسال طلب AJAX للتحقق من قوة كلمة المرور الجديدة
        $.ajax({
            url: "{{ route('password.checkStrength') }}", // المسار للتحقق من قوة كلمة المرور الجديدة
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}", // استخدام CSRF token
                password: newPassword
            },
            success: function(response) {
                $('#new-password-status').html(response.strength_message);
                $('#new-password-status').removeClass().addClass(response.strength_class);
            }
        });
    });
});


</script>
<!-- SweetAlert JS for success and error notifications -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'تم التحديث بنجاح!',
            text: '{{ session('success') }}',
        });
    </script>
@endif

@if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'خطأ!',
            text: '{{ $errors->first() }}',
        });
    </script>
@endif

@endsection
