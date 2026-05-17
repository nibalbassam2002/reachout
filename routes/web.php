<?php
// routes/web.php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboard;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────
// GUEST ROUTES — للزوار غير المسجلين فقط
// middleware('guest') = لو مسجل دخول يُحوَّل للداشبورد
// ─────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});
Route::get('/home', function () {
    return view('frontend.index'); // تأكد أن الاسم يطابق اسم المجلد والملف
});
Route::get('/news', [NewsController::class, 'index'])->name('news');
 
Route::get('/policies', function () {
    return view('frontend.policies');
})->name('policies');
Route::get('/donate-now', function () {
    return view('frontend.donate'); // تأكد من اسم المجلد والملف
})->name('donate.page');

// ─────────────────────────────────────────
// AUTH ROUTES — يحتاج تسجيل دخول
// ─────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Super Admin فقط
    Route::middleware('role:super_admin')
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
             Route::resource('doctors', DoctorController::class);
         });

    // Doctor فقط
    Route::middleware('role:doctor')
         ->prefix('doctor')
         ->name('doctor.')
         ->group(function () {
             Route::get('/dashboard', [DoctorDashboard::class, 'index'])->name('dashboard');
         });
});

Route::get('/', function () {
    return view('frontend.index');
})->name('home');