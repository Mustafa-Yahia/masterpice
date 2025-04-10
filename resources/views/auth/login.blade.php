
@extends('layouts.app')

@section('content')
    <section class="login-section" style="padding: 100px 0; direction: rtl; background-image: url('{{ asset('storage/background/B-login16.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="auto-container">
            <!-- إضافة الشعار في أعلى اليمين -->
            <div style="position: absolute; top: 20px; right: 20px;">
                <img src="{{ asset('path/to/logo.png') }}" alt="Logo" style="width: 100px; height: auto;">
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <div class="login-box shadow p-4 rounded" style="background-color: rgba(255, 255, 255, 0.2); border-radius: 10px; border: 2px solid rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="sec-title centered" style="margin-bottom: 30px;">
                                <h2 style="font-family: 'Cairo', sans-serif; font-weight: 600; font-size: 34px; margin-bottom: 10px;">تسجيل الدخول</h2>
                                <div class="text" style="font-family: 'Cairo', sans-serif; font-size: 16px; line-height: 1.5;">أدخل بياناتك للوصول إلى حسابك والمساهمة في التبرعات</div>
                            </div>

                            <!-- البريد الإلكتروني -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="email" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">البريد الإلكتروني</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="email-icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                           placeholder="أدخل بريدك الإلكتروني"
                                           value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback" style="font-family: 'Cairo', sans-serif;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- كلمة المرور -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="password" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">كلمة المرور</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="password-icon">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                           placeholder="********"
                                           value="{{ old('password') }}" required>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback" style="font-family: 'Cairo', sans-serif;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- تذكرني ونسيت كلمة المرور -->
                            <div class="form-group d-flex justify-content-between" style="margin-top: 20px;">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember" style="font-family: 'Cairo', sans-serif; margin-right:22px; text-align: right;">تذكرني</label>
                                </div>
                                <a href="#" class="text-primary" style="font-family: 'Cairo', sans-serif; color: #007bff;">نسيت كلمة المرور؟</a>
                            </div>

                            <!-- زر تسجيل الدخول -->
                            <button type="submit" class="theme-btn btn-style-one w-100" style="margin-top: 20px;">
                                <span class="btn-title" style="font-family: 'Cairo', sans-serif;">تسجيل الدخول</span>
                            </button>
                        </form>

                        <!-- رابط إنشاء حساب -->
                        <div class="text-center mt-3" style="margin-top: 30px;">
                            <p style="font-family: 'Cairo', sans-serif;">ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-primary">إنشاء حساب جديد</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
@endsection









{{-- @extends('layouts.app')

@section('content')
    <section class="login-section" style="padding: 100px 0; direction: rtl; background-image: url('{{ asset('storage/background/B-login2.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="auto-container">
            <!-- إضافة الشعار في أعلى اليمين -->
            <div style="position: absolute; top: 20px; right: 20px;">
                <img src="{{ asset('path/to/logo.png') }}" alt="Logo" style="width: 100px; height: auto;">
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <div class="login-box shadow p-4 rounded" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px; border: 2px solid rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="sec-title centered" style="margin-bottom: 20px;">
                                <h2 style="font-family: 'Cairo', sans-serif; font-weight: 600; font-size: 34px;">تسجيل الدخول</h2>
                                <div class="text" style="font-family: 'Cairo', sans-serif;">أدخل بياناتك للوصول إلى حسابك والمساهمة في التبرعات</div>
                            </div>

                            <!-- البريد الإلكتروني -->
                            <div class="form-group">
                                <label for="email" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">البريد الإلكتروني</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="email-icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                           placeholder="أدخل بريدك الإلكتروني"
                                           value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback" style="font-family: 'Cairo', sans-serif;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- كلمة المرور -->
                            <div class="form-group">
                                <label for="password" style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">كلمة المرور</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="password-icon">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                           placeholder="********"
                                           value="{{ old('password') }}" required>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback" style="font-family: 'Cairo', sans-serif;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- تذكرني -->
                            <div class="form-group form-check d-flex justify-content-between" style="margin-top: 10px;">
                                <div>
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember" style="font-family: 'Cairo', sans-serif; margin-right:22px; text-align: right;">تذكرني</label>
                                </div>
                                <a href="#" class="text-primary" style="font-family: 'Cairo', sans-serif; color: #007bff;">نسيت كلمة المرور؟</a>
                            </div>

                            <!-- زر تسجيل الدخول -->
                            <button type="submit" class="theme-btn btn-style-one w-100">
                                <span class="btn-title" style="font-family: 'Cairo', sans-serif;">تسجيل الدخول</span>
                            </button>
                        </form>

                        <!-- رابط إنشاء حساب -->
                        <div class="text-center mt-3">
                            <p style="font-family: 'Cairo', sans-serif;">ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-primary">إنشاء حساب جديد</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
@endsection --}}
