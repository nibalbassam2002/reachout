<?php
// routes/web.php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboard;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReachoutController;
use App\Models\BankAccount;
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
    
    $bank = \App\Models\BankAccount::first(); 
    return view('frontend.donate', compact('bank'));
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
             Route::get('/bank-settings', [AdminDashboard::class, 'editBank'])->name('bank.edit');
             Route::post('/bank-settings', [AdminDashboard::class, 'updateBank'])->name('bank.update');
         });

    // Doctor فقط
    Route::middleware('role:doctor')
         ->prefix('doctor')
         ->name('doctor.')
         ->group(function () {
             Route::get('/dashboard', [DoctorDashboard::class, 'index'])->name('dashboard');
         });
});
Route::prefix('reachout')->name('reachout.')->group(function () {
 
    // حفظ طلب جديد من البوب اب
    Route::post('/store',   [ReachoutController::class, 'store'])->name('store');
 
    // البحث عن حالة بالرقم المرجعي (للمتابعة)
    Route::post('/lookup',  [ReachoutController::class, 'lookup'])->name('lookup');
 
    // حفظ متابعة على حالة موجودة
    Route::post('/followup',[ReachoutController::class, 'followup'])->name('followup');
 
});


Route::get('/', function () {
    return view('frontend.index');
})->name('home');