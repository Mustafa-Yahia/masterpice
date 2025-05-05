@extends('layouts.app')

@section('content')
    @if(session('status'))
        <div class="alert alert-success text-center" role="alert" style="font-family: 'Cairo', sans-serif; margin-bottom: 20px;">
            {{ session('status') }}
        </div>
    @endif

    <section class="login-section" style="padding: 80px 0; direction: rtl; background-image: url('{{ asset('storage/background/Backgroundlogin.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="auto-container">
            <div style="position: absolute; top: 20px; right: 20px;">
                <img src="{{ asset('path/to/logo.png') }}" alt="Logo" style="width: 100px; height: auto;">
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="login-box shadow p-4 rounded" style="background-color: rgba(255, 255, 255, 0.6); border-radius: 10px; border: 2px solid rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <div class="sec-title centered" style="margin-bottom: 20px;">
                            <h2 style="font-family: 'Cairo', sans-serif; font-weight: 600; font-size: 34px; margin-bottom: 10px;">إنشاء حساب</h2>
                            <div class="text" style="font-family: 'Cairo', sans-serif; font-size: 16px; line-height: 1.5;">قم بإنشاء حساب جديد للبدء في التبرع</div>
                        </div>

                        <form method="POST" action="{{ route('register') }}" id="register-form">
                            @csrf

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">الاسم الكامل</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" required placeholder="أدخل اسمك الكامل (ثلاثة مقاطع، كل مقطع 3 أحرف على الأقل)" id="name">
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                    <small id="name-error" class="text-danger" style="display: none;">
                                        يجب أن يتكون الاسم من ثلاثة مقاطع، كل مقطع 3 أحرف على الأقل (مثال: أحمد محمد عبدالله)
                                    </small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">رقم الهاتف</label>
                                    <div class="input-group">
                                        <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone') }}" required placeholder="أدخل رقم الهاتف" style="text-align:right;">
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="email" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">البريد الإلكتروني</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required placeholder="أدخل بريدك الإلكتروني">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">كلمة المرور</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                               required placeholder="أدخل كلمة المرور" onkeyup="checkPasswordStrength()">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePasswordVisibility('password')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="password-strength-container" class="password-strength-meter mt-2" style="font-family: 'Cairo', sans-serif; display: none;">
                                        <div class="progress" style="height: 5px;">
                                            <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <small id="password-strength-text" class="form-text text-muted text-right d-block">قوة كلمة المرور: ضعيفة جداً</small>
                                        <ul id="password-requirements" class="list-unstyled text-right" style="font-size: 0.8rem;">
                                            <li id="req-length"><i class="far fa-circle"></i> 8 أحرف على الأقل</li>
                                            <li id="req-uppercase"><i class="far fa-circle"></i> حرف كبير واحد على الأقل</li>
                                            <li id="req-number"><i class="far fa-circle"></i> رقم واحد على الأقل</li>
                                            <li id="req-special"><i class="far fa-circle"></i> حرف خاص واحد على الأقل</li>
                                        </ul>
                                    </div>

                                    @error('password')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">تأكيد كلمة المرور</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required
                                               placeholder="أعد إدخال كلمة المرور" onkeyup="checkPasswordMatch()">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePasswordVisibility('password_confirmation')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small id="password-match-message" class="form-text text-right" style="font-family: 'Cairo', sans-serif;"></small>
                                </div>
                            </div>

                            <div class="form-group text-center" style="margin-top: 20px;">
                                <button type="submit" class="theme-btn btn-style-one w-100">
                                    <span class="btn-title" style="font-family: 'Cairo', sans-serif;"><i class="fas fa-user-plus"></i> إنشاء حساب</span>
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-3" style="margin-top: 20px;">
                            <p style="font-family: 'Cairo', sans-serif; text-align:center;">لديك حساب بالفعل؟
                                <a href="{{ route('login') }}" class="text-primary"
                                   style="transition: all 0.3s ease; position: relative; padding-bottom: 2px;">
                                    <span style="position: relative;">
                                        تسجيل الدخول
                                        <span class="hover-underline" style="position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background-color: #4a6bff; transition: width 0.3s ease;"></span>
                                    </span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <script>
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch("https://ipinfo.io?token=YOUR_IPINFO_TOKEN")
                    .then(response => response.json())
                    .then(data => callback(data.country))
                    .catch(() => callback("JO"));
            },
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        input.addEventListener("input", function() {
            document.querySelector("#phone").value = iti.getNumber();
            console.log(iti.getNumber());
        });

        @if(session('status'))
            Swal.fire({
                icon: 'success',
                title: 'تم إنشاء حسابك بنجاح!',
                text: 'يمكنك الآن تسجيل الدخول.',
                confirmButtonText: 'موافق'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        @endif

        document.getElementById('name').addEventListener('input', function() {
            var name = this.value.trim();
            var nameError = document.getElementById('name-error');

            var nameSegments = name.split(/\s+/).filter(segment => segment.length > 0);

            if (nameSegments.length !== 3 || /[^A-Za-z\u0600-\u06FF ]/.test(name)) {
                nameError.style.display = 'block';
                this.classList.add('is-invalid');
            } else {
                nameError.style.display = 'none';
                this.classList.remove('is-invalid');
            }
        });

document.getElementById('name').addEventListener('input', function() {
    var name = this.value.trim();
    var nameError = document.getElementById('name-error');

    var nameSegments = name.split(/\s+/).filter(segment => segment.length > 0);

    let isValid = true;
    if (nameSegments.length !== 3) {
        isValid = false;
    } else {
        for (let segment of nameSegments) {
            if (segment.length < 3) {
                isValid = false;
                break;
            }
        }
    }

    if (/[^A-Za-z\u0600-\u06FF ]/.test(name)) {
        isValid = false;
    }

    if (!isValid) {
        nameError.style.display = 'block';
        this.classList.add('is-invalid');
    } else {
        nameError.style.display = 'none';
        this.classList.remove('is-invalid');
    }
});


        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const container = document.getElementById('password-strength-container');
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');

            // إظهار/إخفاء المؤشر حسب وجود نص
            if (password.length > 0) {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
                return;
            }

            let strength = 0;

            // التحقق من الطول
            if (password.length >= 8) {
                strength += 1;
                document.getElementById('req-length').innerHTML = '<i class="fas fa-check-circle" style="color:green"></i> 8 أحرف على الأقل';
            } else {
                document.getElementById('req-length').innerHTML = '<i class="far fa-circle"></i> 8 أحرف على الأقل';
            }

            // التحقق من وجود حرف كبير
            if (/[A-Z]/.test(password)) {
                strength += 1;
                document.getElementById('req-uppercase').innerHTML = '<i class="fas fa-check-circle" style="color:green"></i> حرف كبير واحد على الأقل';
            } else {
                document.getElementById('req-uppercase').innerHTML = '<i class="far fa-circle"></i> حرف كبير واحد على الأقل';
            }

            // التحقق من وجود رقم
            if (/[0-9]/.test(password)) {
                strength += 1;
                document.getElementById('req-number').innerHTML = '<i class="fas fa-check-circle" style="color:green"></i> رقم واحد على الأقل';
            } else {
                document.getElementById('req-number').innerHTML = '<i class="far fa-circle"></i> رقم واحد على الأقل';
            }

            // التحقق من وجود حرف خاص
            if (/[^A-Za-z0-9]/.test(password)) {
                strength += 1;
                document.getElementById('req-special').innerHTML = '<i class="fas fa-check-circle" style="color:green"></i> حرف خاص واحد على الأقل';
            } else {
                document.getElementById('req-special').innerHTML = '<i class="far fa-circle"></i> حرف خاص واحد على الأقل';
            }

            // تحديث شريط القوة والنص
            const strengthPercent = (strength / 4) * 100;
            strengthBar.style.width = strengthPercent + '%';

            if (strength === 0) {
                strengthText.textContent = 'قوة كلمة المرور: ضعيفة جداً';
                strengthBar.className = 'progress-bar bg-danger';
            } else if (strength === 1) {
                strengthText.textContent = 'قوة كلمة المرور: ضعيفة';
                strengthBar.className = 'progress-bar bg-danger';
            } else if (strength === 2) {
                strengthText.textContent = 'قوة كلمة المرور: متوسطة';
                strengthBar.className = 'progress-bar bg-warning';
            } else if (strength === 3) {
                strengthText.textContent = 'قوة كلمة المرور: جيدة';
                strengthBar.className = 'progress-bar bg-info';
            } else if (strength === 4) {
                strengthText.textContent = 'قوة كلمة المرور: قوية جداً';
                strengthBar.className = 'progress-bar bg-success';
            }
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const messageElement = document.getElementById('password-match-message');

            if (confirmPassword.length === 0) {
                messageElement.textContent = '';
                return;
            }

            if (password === confirmPassword) {
                messageElement.textContent = 'كلمة المرور متطابقة';
                messageElement.className = 'form-text text-success';
            } else {
                messageElement.textContent = 'كلمة المرور غير متطابقة';
                messageElement.className = 'form-text text-danger';
            }
        }

        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const button = document.querySelector(`#${fieldId} ~ .input-group-append .toggle-password i`);

            if (field.type === 'password') {
                field.type = 'text';
                button.className = 'fas fa-eye-slash';
            } else {
                field.type = 'password';
                button.className = 'fas fa-eye';
            }
        }
    </script>
@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.2/dist/sweetalert2.min.css" rel="stylesheet">

    <style>

        .login-section {
            background-color: #f8f9fa;
        }

        .login-box {
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .theme-btn {
            background-color: #;
            color: #fff;
            font-family: 'Cairo', sans-serif;
            padding: 12px;
            font-size: 16px;
        }

        .theme-btn:hover {
            background-color: #3cc88f;
        }

        .form-control {
            font-family: 'Cairo', sans-serif;
            height: 50px;
            padding: 10px;
        }

        .form-check-label {
            font-family: 'Cairo', sans-serif;
        }

        /* تخصيص لرسائل الخطأ */
        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            text-align: right;
            display: block;
            color: #dc3545;
            font-family: 'Cairo', sans-serif;
        }

        /* تخصيص زر تذكرني */
        .form-check-label {
            font-family: 'Cairo', sans-serif;
            margin-right: 10px;
        }

        /* تحسين الرسائل التحذيرية */
        .invalid-feedback {
            text-align: right;
            font-size: 14px;
            color: #dc3545;
            margin-top: 5px;
            font-weight: 500;
        }

        #name-error {
            display: none;
            text-align: right;
            font-size: 14px;
            color: #dc3545;
            font-weight: 500;
            margin-top: 5px;
        }

        /* تخصيص مؤشر قوة كلمة المرور */
        .password-strength-meter {
            transition: all 0.3s ease;
        }

        #password-requirements li {
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        #password-requirements i {
            margin-left: 5px;
        }

        .progress {
            background-color: #e9ecef;
            border-radius: 2px;
        }

        .progress-bar {
            transition: width 0.3s ease;
        }
    </style>
@endsection





