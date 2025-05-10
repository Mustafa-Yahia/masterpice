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
use App\Http\Controllers\Admin\AdminCauseController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Designer\DesignerController;
use App\Http\Controllers\Designer\DesignerTimelineController;
use App\Http\Controllers\Designer\DesignerTeamController;
use App\Http\Controllers\about\AboutController;



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
});// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/avatar', [UserProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    // AJAX Routes
    Route::post('/profile/check-password', [UserProfileController::class, 'checkCurrentPassword'])->name('password.checkCurrentPassword');
    Route::post('/profile/check-strength', [UserProfileController::class, 'checkPasswordStrength'])->name('password.checkStrength');

    // Other profile routes
    Route::get('/profile/donations', [UserProfileController::class, 'donations'])->name('profile.donations');
    Route::get('/profile/subscriptions', [UserProfileController::class, 'subscriptions'])->name('profile.subscriptions');
});


// مسار لوحة تحكم الادمن
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
});


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});





Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Routes إدارة الحملات
    Route::prefix('causes')->name('causes.')->group(function () {
        Route::get('/', [AdminCauseController::class, 'index'])->name('index');
        Route::get('/create', [AdminCauseController::class, 'create'])->name('create');
        Route::post('/', [AdminCauseController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminCauseController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminCauseController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminCauseController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminCauseController::class, 'destroy'])->name('destroy');
    });

});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [AdminEventController::class, 'index'])->name('index');
        Route::get('/create', [AdminEventController::class, 'create'])->name('create');
        Route::post('/', [AdminEventController::class, 'store'])->name('store');
        Route::get('/{event}', [AdminEventController::class, 'show'])->name('show');
        Route::get('/{event}/edit', [AdminEventController::class, 'edit'])->name('edit');
        Route::put('/{event}', [AdminEventController::class, 'update'])->name('update');
        Route::delete('/{event}', [AdminEventController::class, 'destroy'])->name('destroy');
        Route::post('/{event}/remove-volunteer/{volunteer}', [AdminEventController::class, 'removeVolunteer'])
        ->name('removeVolunteer');
    });
});



Route::get('/admin/dashboard/get-yearly-data', [DashboardController::class, 'getYearlyData']);

// Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
//     Route::resource('events', \App\Http\Controllers\Admin\AdminEventController::class);
// });


// Password Reset Routes
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('/about', [TeamController::class, 'index'])->name('about');


Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])
    ->name('about');

Route::prefix('designer')->group(function () {
    Route::resource('timeline', TimelineController::class);
});



    Route::get('/admin/about/team', [TeamController::class, 'index'])->name('admin.about.team');
    Route::get('/admin/about/timeline', [TeamController::class, 'index'])->name('admin.about.timeline');




Route::prefix('designer')->group(function () {
    Route::resource('timeline', TimelineController::class);
});

Route::prefix('designer')->middleware(['auth'])->group(function () {
    // لوحة تحكم المصمم الرئيسية
    Route::get('/dashboard', [DesignerController::class, 'index'])->name('designer.dashboard');
    // روابط أحداث الجدول الزمني (Timeline Events)
    Route::prefix('timeline')->group(function () {
        Route::get('/create', [DesignerController::class, 'createTimelineEvent'])->name('designer.timeline.create');
        Route::post('/store', [DesignerController::class, 'storeTimelineEvent'])->name('designer.timeline.store');
        Route::get('/{id}/edit', [DesignerController::class, 'editTimelineEvent'])->name('designer.timeline.edit');
        Route::put('/{id}/update', [DesignerController::class, 'updateTimelineEvent'])->name('designer.timeline.update');
        Route::delete('/{id}/delete', [DesignerController::class, 'destroyTimelineEvent'])->name('designer.timeline.destroy');
    });

    // ... (يمكن إضافة روابط أخرى للـ Team هنا إذا كانت موجودة)
});

  Route::middleware(['auth', 'can:view_dashboard'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('admin.dashboard.chart-data');
});



Route::prefix('designer')->group(function () {
    Route::get('/about', [AboutController::class, 'index'])->name('designer.about');
    Route::resource('/timeline', TimelineController::class);
    Route::get('/team', [TeamController::class, 'index'])->name('designer.team');
    Route::get('/statistics', [StatsController::class, 'index'])->name('designer.statistics');
});

Route::prefix('designer')->name('designer.')->group(function () {
    Route::get('timeline', [DesignerTimelineController::class, 'index'])->name('timeline.index');
    Route::get('timeline/create', [DesignerTimelineController::class, 'create'])->name('timeline.create');
    Route::post('timeline', [DesignerTimelineController::class, 'store'])->name('timeline.store');
    Route::get('timeline/{timeline}/edit', [DesignerTimelineController::class, 'edit'])->name('timeline.edit');
    Route::put('timeline/{timeline}', [DesignerTimelineController::class, 'update'])->name('timeline.update');
    Route::delete('timeline/{timeline}', [DesignerTimelineController::class, 'destroy'])->name('timeline.destroy');
});



Route::prefix('designer')->name('designer.')->group(function () {
    Route::resource('team', DesignerTeamController::class);
});


Route::get('/about', [AboutController::class, 'index'])->name('about');


