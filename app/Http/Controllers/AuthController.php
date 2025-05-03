<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',  // تحقق من وجود البريد في قاعدة البيانات
            'password' => 'required|min:6', // تحقق من وجود كلمة مرور صحيحة
        ], [
            'email.exists' => 'البريد الإلكتروني غير مسجل في قاعدة البيانات.',
            'password.min' => 'يجب أن تكون كلمة المرور على الأقل 6 أحرف.',
        ]);

        // التحقق من البيانات
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // التحقق من وجود الخيار "تذكرني"

        // محاولة تسجيل الدخول
        if (Auth::attempt($credentials, $remember)) {
            if ($remember) {
                // تخزين البريد الإلكتروني وكلمة المرور في الكوكي
                Cookie::queue('remember_email', $request->email, 43200);  // تخزين البريد الإلكتروني في الكوكي
                Cookie::queue('remember_password', $request->password, 43200);  // تخزين كلمة المرور في الكوكي
            } else {
                // مسح الكوكي عند عدم تفعيل "تذكرني"
                Cookie::queue(Cookie::forget('remember_email'));
                Cookie::queue(Cookie::forget('remember_password'));
            }

            // التحقق من دور المستخدم
            if (Auth::user()->role == 'admin') {
                // إذا كان المستخدم أدمن، توجيهه إلى لوحة التحكم الخاصة بالأدمن
                return redirect()->route('admin.dashboard');
            }

            // إذا كان المستخدم ليس أدمن، توجيهه إلى الصفحة الرئيسية أو صفحة أخرى
            return redirect()->intended('/');
        }

        // إذا كانت البيانات غير صحيحة
        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ])->withInput($request->only('email'));
    }


    // عرض صفحة التسجيل
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:3',
                'regex:/^[\p{Arabic}\s]+$/u',
                function ($attribute, $value, $fail) {
                    $segments = preg_split('/\s+/', trim($value));

                    // التحقق من وجود 3 مقاطع
                    if (count($segments) < 3) {
                        $fail('يجب أن يتكون الاسم من ثلاثة مقاطع (مثال: أحمد محمد عبدالله)');
                        return;
                    }

                    // التحقق من أن كل مقطع يحتوي على 3 أحرف على الأقل
                    foreach ($segments as $segment) {
                        if (mb_strlen($segment) < 3) {
                            $fail('يجب أن يحتوي كل مقطع من الاسم على 3 أحرف على الأقل');
                            return;
                        }
                    }
                },
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'phone' => 'required|unique:users,phone|regex:/^(\+?\d{1,3}?)?(\d{10})$/',  // التحقق من أن رقم الهاتف غير مكرر
        ], [
            'name.required' => 'الاسم الكامل مطلوب.',
            'name.min' => 'يجب أن يحتوي الاسم على 3 أحرف على الأقل.',
            'name.regex' => 'الاسم يجب أن يحتوي على حروف عربية فقط.',
            'email.unique' => 'البريد الإلكتروني مسجل بالفعل.',
            'password.min' => 'يجب أن تكون كلمة المرور على الأقل 8 أحرف.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'password.regex' => 'يجب أن تحتوي كلمة المرور على حرف كبير، حرف صغير، رقم، ورمز خاص.',
            'phone.unique' => 'رقم الهاتف مسجل بالفعل.',
            'phone.regex' => 'رقم الهاتف غير صحيح. يرجى التأكد من إدخال رقم صحيح.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // إنشاء المستخدم
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'donor',
        ]);

        // إرسال رسالة نجاح إلى الجلسة
        return redirect()->route('login')->with([
            'status' => 'تم إنشاء الحساب بنجاح! يمكنك الآن تسجيل الدخول.',
        ]);
    }


    // تسجيل الخروج
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}



















// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Cookie;
// use Illuminate\Support\Facades\Auth;


// class AuthController extends Controller
// {

//     public function showLogin()
//     {
//         return view('auth.login');
//     }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required|min:6',
//         ]);

//         $credentials = $request->only('email', 'password');
//         $remember = $request->has('remember');

//         if (Auth::attempt($credentials, $remember)) {

//             if ($remember) {
//                 Cookie::queue('remember_email', $request->email, 43200);
//                 Cookie::queue('remember_password', $request->password, 43200);
//             } else {
//                 Cookie::queue(Cookie::forget('remember_email'));
//                 Cookie::queue(Cookie::forget('remember_password'));
//             }

//             return redirect()->intended('/');
//         }

//         return back()->withErrors([
//             'email' => 'بيانات الدخول غير صحيحة.',
//         ])->withInput($request->only('email'));
//     }




//     public function showRegistrationForm()
//     {
//         return view('auth.register');
//     }

//     public function store(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//             'phone' => 'nullable|string|max:15',
//         ]);

//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//         User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'phone' => $request->phone,
//             'role' => 'donor',
//         ]);

//         session()->flash('success', 'تم إنشاء الحساب بنجاح! يمكنك الآن تسجيل الدخول.');

//         return redirect()->route('login');
//     }




// public function logout()
// {
//     Auth::logout();
//     return redirect()->route('login');
// }
// }
