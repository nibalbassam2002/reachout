<?php
// routes/web.php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboard;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────
// GUEST ROUTES — للزوار غير المسجلين فقط
// middleware('guest') = لو مسجل دخول يُحوَّل للداشبورد
// ─────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

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
         });

    // Doctor فقط
    Route::middleware('role:doctor')
         ->prefix('doctor')
         ->name('doctor.')
         ->group(function () {
             Route::get('/dashboard', [DoctorDashboard::class, 'index'])->name('dashboard');
         });
});

// الصفحة الرئيسية → توجيه للـ login
Route::get('/', fn() => redirect()->route('login'));