@extends('layouts.app')

@section('content')
    <section class="login-section" style="padding: 100px 0; background-color: #f8f9fa;">
        <div class="auto-container">
            <div class="sec-title centered">
                <h2>تسجيل الدخول</h2>
                <div class="text">أدخل بياناتك للوصول إلى حسابك والمساهمة في التبرعات</div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <div class="login-box shadow p-4 rounded bg-white">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" id="email" name="email" class="form-control"
                                       placeholder="أدخل بريدك الإلكتروني"
                                       value="{{ old('email', Cookie::get('remember_email')) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">كلمة المرور</label>
                                <input type="password" id="password" name="password" class="form-control"
                                       placeholder="********"
                                       value="{{ old('password', Cookie::get('remember_password')) }}" required>
                            </div>

                            <div class="form-group form-check d-flex justify-content-between">
                                <div>
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                           {{ Cookie::has('remember_email') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">تذكرني</label>
                                </div>
                                <a href="#" class="text-primary">نسيت كلمة المرور؟</a>
                            </div>

                            <button type="submit" class="theme-btn btn-style-one w-100">
                                <span class="btn-title">تسجيل الدخول</span>
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <p>ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-primary">إنشاء حساب جديد</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
