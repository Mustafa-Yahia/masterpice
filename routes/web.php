<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminDonationController;



// الصفحة الرئيسية
Route::get('/', [DonationCategoryController::class, 'indexWithCauses'])->name('index');

// صفحة تسجيل الدخول
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// صفحة التسجيل
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'store']);

// تسجيل الخروج
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// حماية صفحة المسؤول Middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// حماية الصفحة الرئيسية بعد تسجيل الدخول
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DonationCategoryController::class, 'index'])->name('home');

    // إضافة صفحة التطوع داخل مجموعة الحماية
    Route::get('/volunteer', [VolunteerController::class, 'showForm'])->name('volunteer.form');
    Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');
});

// Route لصفحات القضايا
Route::get('/causes', [CauseController::class, 'cause'])->name('cause.index');
Route::get('/cause/{id}', [CauseController::class, 'show'])->name('cause.show');
Route::get('/cause/{id}/donations', [CauseController::class, 'showDonations'])->name('cause.donations');
Route::get('/filter-causes', [CauseController::class, 'cause'])->name('cause.filter');

// Route التبرع
Route::get('/donate/{id}', [DonationController::class, 'create'])->name('donation.form');
Route::post('/donate/store', [DonationController::class, 'store'])->name('donation.store');

// Routes الخاصة بالأحداث
Route::get('events', [EventController::class, 'index'])->name('event.index');  // عرض قائمة الأحداث
Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');  // عرض تفاصيل الحدث
// Route::post('event/{id}/register', [EventController::class, 'register'])->name('event.register');  // تسجيل المستخدم في الحدث
// Route to handle the event subscription
Route::get('/event/{id}/subscribe', [EventController::class, 'subscribe'])->name('event.subscribe');


// Route تأكيد التبرع
Route::post('/donation/confirm', [DonationController::class, 'confirmDonation'])->name('donation.confirm');
Route::get('/event/{eventId}/user/{userId}/status/{status}', [EventController::class, 'updateSubscriptionStatus'])
    ->name('event.updateSubscriptionStatus');

// مسارات حماية للـ donations
Route::middleware(['auth'])->group(function () {
    Route::post('/donation/store', [DonationController::class, 'store'])->name('donation.store');
    Route::get('/donation/thank-you', function () {
        return view('DonationThankYou');
    })->name('donation.thank-you');
});

// مسار للصور من مجلد `storage` (اختياري إذا كنت تواجه مشاكل في عرض الصور)
Route::get('storage/{file}', function($file) {
    $path = storage_path('app/public/images/' . $file);
    if (file_exists($path)) {
        return response()->file($path);
    }
    abort(404);
});
// عرض الملف الشخصي
Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');

Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update'); // لتحديث البيانات

// تحديث كلمة المرور
Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('password.update');

// عرض التبرعات
Route::get('/profile/donations', [UserProfileController::class, 'donations'])->name('profile.donations');

// عرض طلبات الاشتراك في التطوع
Route::get('event/subscribe/{eventId}', [EventController::class, 'subscribe'])->name('event.subscribe');
Route::get('/profile/subscriptions', [UserProfileController::class, 'subscriptions'])->name('profile.subscriptions');

// routes/web.php
// routes/web.php
Route::get('/event/subscribe/{event}', [EventController::class, 'subscribe'])->name('event.subscribe')->middleware('auth');

Route::post('/password/check-current-password', [UserProfileController::class, 'checkCurrentPassword'])->name('password.checkCurrentPassword');
Route::post('/password/check-strength', [UserProfileController::class, 'checkPasswordStrength'])->name('password.checkStrength');


// مسار لوحة تحكم الادمن
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});




Route::prefix('admin')->name('admin.')->middleware('auth', 'admin')->group(function () {
    Route::resource('donations', AdminDonationController::class);
});
