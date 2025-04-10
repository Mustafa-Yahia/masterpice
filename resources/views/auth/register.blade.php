@extends('layouts.app')

@section('content')
    <!-- رسالة النجاح عند إتمام التسجيل بنجاح -->
    @if(session('status'))
        <div class="alert alert-success text-center" role="alert" style="font-family: 'Cairo', sans-serif; margin-bottom: 20px;">
            {{ session('status') }}
        </div>
    @endif

    <section class="login-section" style="padding: 80px 0; direction: rtl; background-image: url('{{ asset('storage/background/B-login2.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="auto-container">
            <!-- إضافة الشعار في أعلى اليمين -->
            <div style="position: absolute; top: 20px; right: 20px;">
                <img src="{{ asset('path/to/logo.png') }}" alt="Logo" style="width: 100px; height: auto;">
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="login-box shadow p-4 rounded" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px; border: 2px solid rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <div class="sec-title centered" style="margin-bottom: 20px;">
                            <h2 style="font-family: 'Cairo', sans-serif; font-weight: 600; font-size: 34px; margin-bottom: 10px;">إنشاء حساب</h2>
                            <div class="text" style="font-family: 'Cairo', sans-serif; font-size: 16px; line-height: 1.5;">قم بإنشاء حساب جديد للبدء في التبرع</div>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <!-- الاسم الكامل -->
                                    <label for="name" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">الاسم الكامل</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" required placeholder="أدخل اسمك الكامل">
                                    </div>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <!-- رقم الهاتف -->
                                    <label for="phone" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">رقم الهاتف</label>
                                    <div class="input-group">
                                        <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone') }}" required placeholder="أدخل رقم الهاتف" style="text-align:right;">
                                    </div>
                                    @error('phone')
                                        <span class="text-danger" style="text-align: right; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <!-- البريد الإلكتروني -->
                                    <label for="email" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">البريد الإلكتروني</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required placeholder="أدخل بريدك الإلكتروني">
                                    </div>
                                    @error('email') <span class="text-danger" style="text-align: right;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <!-- كلمة المرور -->
                                    <label for="password" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">كلمة المرور</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                               required placeholder="أدخل كلمة المرور">
                                    </div>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- تأكيد كلمة المرور -->
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">تأكيد كلمة المرور</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control" required
                                               placeholder="أعد إدخال كلمة المرور">
                                    </div>
                                </div>
                            </div>

                            <!-- زر إنشاء حساب -->
                            <div class="form-group text-center" style="margin-top: 20px;">
                                <button type="submit" class="theme-btn btn-style-one w-100">
                                    <span class="btn-title" style="font-family: 'Cairo', sans-serif;"><i class="fas fa-user-plus"></i> إنشاء حساب</span>
                                </button>
                            </div>
                        </form>

                        <!-- رابط تسجيل الدخول -->
                        <div class="text-center mt-3" style="margin-top: 20px;">
                            <p style="font-family: 'Cairo', sans-serif;">لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-primary">تسجيل الدخول</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- intl-tel-input (لإضافة رموز الدول في رقم الهاتف) -->
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
                    .catch(() => callback("US"));
            },
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        input.addEventListener("input", function() {
            // عند كل إدخال، نقوم بتحديث حقل phone بقيمة الرقم الكامل
            document.querySelector("#phone").value = iti.getNumber();
            console.log(iti.getNumber());  // تحقق من الرقم المرسل
        });

        @if(session('status'))
            Swal.fire({
                icon: 'success',
                title: 'تم إنشاء حسابك بنجاح!',
                text: 'يمكنك الآن تسجيل الدخول.',
                confirmButtonText: 'موافق'
            });
        @endif
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
            background-color: #007bff;
            color: #fff;
            font-family: 'Cairo', sans-serif;
            padding: 12px;
            font-size: 16px;
        }

        .theme-btn:hover {
            background-color: #0056b3;
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
            display: block;
            color: #dc3545;
            font-family: 'Cairo', sans-serif;
        }
    </style>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.2/dist/sweetalert2.all.min.js"></script>
@endsection
