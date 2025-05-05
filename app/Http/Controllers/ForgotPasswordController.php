<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // عرض نموذج طلب إعادة تعيين كلمة المرور
    public function showForgetPasswordForm()
    {
        return view('auth.forget-password');
    }

    // معالجة طلب إعادة تعيين كلمة المرور
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forget-password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('إعادة تعيين كلمة المرور');
        });

        return back()->with('success', 'لقد أرسلنا رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني!');
    }

    // عرض نموذج إعادة تعيين كلمة المرور
    public function showResetPasswordForm($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    // معالجة إعادة تعيين كلمة المرور
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                              'email' => $request->email,
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'الرابط غير صالح!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('success', 'تم تغيير كلمة المرور بنجاح!');
    }
}
