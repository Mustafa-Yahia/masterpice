<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .email-header img {
            max-width: 150px;
        }
        .email-title {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 20px;
        }
        .email-body {
            margin-bottom: 30px;
        }
        .reset-btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('path/to/logo.png') }}" alt="Logo">
        </div>

        <h2 class="email-title">إعادة تعيين كلمة المرور</h2>

        <div class="email-body">
            <p>مرحباً،</p>
            <p>لقد تلقينا طلباً لإعادة تعيين كلمة المرور لحسابك. يمكنك إعادة تعيين كلمة المرور بالنقر على الزر أدناه:</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('reset.password.get', $token) }}" class="reset-btn">إعادة تعيين كلمة المرور</a>
            </div>

            <p>إذا لم تطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذا البريد الإلكتروني.</p>
            <p>ينتهي صلاحية هذا الرابط خلال 60 دقيقة من وقت إرساله.</p>
        </div>

        <div class="email-footer">
            <p>شكراً لاستخدامك تطبيقنا</p>
            <p>© {{ date('Y') }} جميع الحقوق محفوظة</p>
        </div>
    </div>
</body>
</html>
