<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationCategoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\CauseController;



// الصفحة الرئيسية
// // الصفحة الرئيسية لعرض التبرعات والفئات
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

// Route::get('/', [CauseController::class, 'index']);
Route::get('/cause/{id}', [CauseController::class, 'show'])->name('cause.show');

Route::post('/donation/{id}/process', [DonationCategoryController::class, 'processDonation'])->name('donation.process');
Route::get('/donations/separate', [DonationCategoryController::class, 'separateDonations'])->name('donations.separate');
Route::get('/donation/{id}', [DonationCategoryController::class, 'show'])->name('donation.show');



