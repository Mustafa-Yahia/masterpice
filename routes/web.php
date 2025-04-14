<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationCategoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\DonationController;



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

// Route::get('/', [CauseController::class, 'index']);
Route::get('/causes', [CauseController::class, 'cause'])->name('cause.index');
Route::get('/cause/{id}', [CauseController::class, 'show'])->name('cause.show');
Route::get('/cause/{id}/donations', [CauseController::class, 'showDonations'])->name('cause.donations');
Route::get('/filter-causes', [CauseController::class, 'cause'])->name('cause.filter');

Route::get('/donate/{id}', [DonationController::class, 'create'])->name('donation.form');
Route::post('/donate/store', [DonationController::class, 'store'])->name('donation.store');
// Route::post('/donation/{id}/process', [DonationCategoryController::class, 'processDonation'])->name('donation.process');
// Route::get('/donations/separate', [DonationCategoryController::class, 'separateDonations'])->name('donations.separate');
// Route::get('/donation/{id}', [DonationCategoryController::class, 'show'])->name('donation.show');
// Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');



Route::post('/donation/confirm', [DonationController::class, 'confirmDonation'])->name('donation.confirm');

Route::middleware(['auth'])->group(function () {
    Route::post('/donation/store', [DonationController::class, 'store'])->name('donation.store');
    Route::get('/donation/thank-you', function () {
        return view('DonationThankYou');
    })->name('donation.thank-you');
});

