@extends('layouts.app')

@section('content')
    <section class="login-section"
        style="padding: 100px 0; direction: rtl; background-image: url('{{ asset('storage/background/Backgroundlogin.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="auto-container">
            <div style="position: absolute; top: 20px; right: 20px;">
                <img src="{{ asset('path/to/logo.png') }}" alt="Logo" style="width: 100px; height: auto;">
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <div class="login-box shadow p-4 rounded"
                        style="background-color: rgba(255, 255, 255, 0.6); border-radius: 10px; border: 2px solid rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <form method="POST" action="{{ route('forget.password.post') }}">
                            @csrf
                            <div class="sec-title centered" style="margin-bottom: 30px;">
                                <h2
                                    style="font-family: 'Cairo', sans-serif; font-weight: 600; font-size: 34px; margin-bottom: 10px;">
                                    نسيت كلمة المرور</h2>
                                <div class="text"
                                    style="font-family: 'Cairo', sans-serif; font-size: 16px; line-height: 1.5;">أدخل بريدك الإلكتروني لإرسال رابط إعادة تعيين كلمة المرور</div>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success" style="font-family: 'Cairo', sans-serif;">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger" style="font-family: 'Cairo', sans-serif;">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- البريد الإلكتروني -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="email"
                                    style="font-family: 'Cairo', sans-serif; text-align: right; display: block;">البريد
                                    الإلكتروني</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="email-icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required
                                        placeholder="أدخل بريدك الإلكتروني">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback" style="font-family: 'Cairo', sans-serif; display: block;">
                                        {{ $message }}</div>
                                @enderror
                            </div>

                            <!-- زر إرسال الرابط -->
                            <button type="submit" class="theme-btn btn-style-one w-100" style="margin-top: 20px;">
                                <span class="btn-title" style="font-family: 'Cairo', sans-serif;">
                                    <i class="fas fa-paper-plane"></i> إرسال رابط إعادة التعيين
                                </span>
                            </button>
                        </form>

                        <!-- رابط العودة لتسجيل الدخول -->
                        <div class="text-center mt-3" style="margin-top: 30px;">
                            <p style="font-family: 'Cairo', sans-serif; text-align:center;">تذكرت كلمة المرور؟ <a
                                    href="{{ route('login') }}" class="text-primary">تسجيل الدخول</a></p>
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
        /* نفس الأنماط الموجودة في ملف تسجيل الدخول */
    </style>
@endsection
