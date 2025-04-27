<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;
use App\Models\Donation;

class UserProfileController extends Controller
{
  public function index()
    {
        // جلب بيانات المستخدم الحالي
        $user = Auth::user();

        // جلب الاشتراكات التي تم الموافقة عليها فقط
        $subscriptions = Auth::user()->events()->get();  // إزالة wherePivot('status', 'approved')

        // عرض صفحة الملف الشخصي مع البيانات اللازمة
        return view('profile.profile', compact('user', 'subscriptions'));
    }


    // تحديث اسم المستخدم والبريد الإلكتروني
    public function update(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',  // التحقق من أن الاسم غير فارغ وطوله لا يتجاوز 255 حرفًا
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(), // التحقق من أن البريد الإلكتروني غير موجود مسبقًا
        ]);

        // جلب المستخدم الحالي
        $user = Auth::user();

        // تحديث البيانات
        $user->name = $request->name;
        $user->email = $request->email;

        // حفظ التغييرات
        $user->save();

        // إعادة التوجيه مع رسالة نجاح باستخدام SweetAlert
        return redirect()->route('profile.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    // تحديث كلمة المرور
    public function updatePassword(Request $request)
    {
        // تحقق من أن كلمة المرور الحالية صحيحة
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', function($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail('كلمة المرور الحالية غير صحيحة');
                }
            }],
            'new_password' => 'required|min:8|confirmed',  // التحقق من أن كلمة المرور الجديدة تتكون من 8 أحرف على الأقل ومؤكدة
        ]);

        // إذا كان هناك أخطاء في التحقق
        if ($validator->fails()) {
            return redirect()->route('profile.index')
                ->withErrors($validator) // إظهار الأخطاء
                ->withInput();  // الحفاظ على المدخلات القديمة
        }

        // تحديث كلمة المرور
        Auth::user()->update(['password' => Hash::make($request->new_password)]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('profile.index')->with('success', 'تم تحديث كلمة المرور بنجاح');
    }

    // عرض التبرعات الخاصة بالمستخدم
    public function donations()
    {
        // جلب التبرعات الخاصة بالمستخدم
        $donations = Auth::user()->donations;

        // جلب الاشتراكات (إذا كان لديك حاجة لعرضها في Sidebar)
        $subscriptions = Auth::user()->events;

        // عرض التبرعات في الـ View مع الـ Sidebar
        return view('profile.donations', compact('donations', 'subscriptions'));
    }

    // عرض طلبات الاشتراك في التطوع
    public function subscriptions()
    {
        // جلب الاشتراكات الخاصة بالمستخدم (الأحداث التي اشترك فيها)
        $subscriptions = Auth::user()->events;

        // عرض الاشتراكات في الـ View
        return view('profile.subscriptions', compact('subscriptions'));
    }



     // التحقق من كلمة المرور الحالية
     public function checkCurrentPassword(Request $request)
     {
         $currentPassword = $request->current_password;

         if (Hash::check($currentPassword, Auth::user()->password)) {
             return response()->json([
                 'message' => 'كلمة المرور الحالية صحيحة',
                 'class' => 'strong',
             ]);
         }

         return response()->json([
             'message' => 'كلمة المرور الحالية غير صحيحة',
             'class' => 'weak',
         ]);
     }

     // التحقق من قوة كلمة المرور الجديدة
     public function checkPasswordStrength(Request $request)
     {
         $password = $request->password;

         // التحقق من طول كلمة المرور
         $strength = ['message' => '', 'class' => ''];

         if (strlen($password) < 6) {
             $strength['message'] = 'كلمة المرور ضعيفة';
             $strength['class'] = 'weak';
         } elseif (strlen($password) >= 6 && strlen($password) < 10) {
             $strength['message'] = 'كلمة المرور متوسطة';
             $strength['class'] = 'medium';
         } elseif (strlen($password) >= 10 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
             $strength['message'] = 'كلمة المرور قوية';
             $strength['class'] = 'strong';
         } else {
             $strength['message'] = 'كلمة المرور متوسطة';
             $strength['class'] = 'medium';
         }

         return response()->json($strength);
     }
}
