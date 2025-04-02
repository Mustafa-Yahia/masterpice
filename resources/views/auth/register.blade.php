@extends('layouts.app')

@section('content')
    <section class="login-section" style="padding: 80px 0;">
        <div class="auto-container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="login-box shadow p-4 rounded bg-white">
                        <div class="sec-title centered">
                            <h2>إنشاء حساب</h2>
                            <div class="text">قم بإنشاء حساب جديد للبدء في التبرع</div>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">الاسم الكامل</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required placeholder="أدخل اسمك الكامل">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required placeholder="أدخل بريدك الإلكتروني">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">رقم الهاتف</label>
                                <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}" required>
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">كلمة المرور</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       required placeholder="أدخل كلمة المرور">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">تأكيد كلمة المرور</label>
                                <input type="password" name="password_confirmation" class="form-control" required
                                       placeholder="أعد إدخال كلمة المرور">
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="theme-btn btn-style-one w-100">
                                    <span class="btn-title">إنشاء حساب</span>
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <p>لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-primary">تسجيل الدخول</a></p>
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
    </script>
@endsection
