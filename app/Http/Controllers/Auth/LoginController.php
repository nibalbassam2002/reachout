<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ─────────────────────────────────────────
    // عرض صفحة تسجيل الدخول
    // ─────────────────────────────────────────
    public function showForm()
    {
        return view('auth.login');
    }

    // ─────────────────────────────────────────
    // معالجة تسجيل الدخول
    // ─────────────────────────────────────────
    public function login(Request $request)
    {
        // 1. التحقق من البيانات المُدخلة
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            // رسائل خطأ بالعربية
            'email.required'    => 'البريد الإلكتروني مطلوب',
            'email.email'       => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

        // 2. هل الحساب موجود وهل هو نشط؟
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'البريد الإلكتروني غير مسجل'
            ])->withInput($request->only('email'));
        }

        if (!$user->is_active) {
            return back()->withErrors([
                'email' => 'هذا الحساب موقوف. تواصل مع المشرف'
            ])->withInput($request->only('email'));
        }

        // 3. محاولة تسجيل الدخول
        // remember: تذكرني (اختياري)
        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()->withErrors([
                'password' => 'كلمة المرور غير صحيحة'
            ])->withInput($request->only('email'));
        }

        // 4. تجديد الـ session (حماية من CSRF)
        $request->session()->regenerate();

        // 5. تسجيل وقت آخر دخول
        $user->update(['last_login_at' => now()]);

        // 6. توجيه حسب الدور
        return $this->redirectByRole(Auth::user());
    }

    // ─────────────────────────────────────────
    // تسجيل الخروج
    // ─────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'تم تسجيل الخروج بنجاح');
    }

    // ─────────────────────────────────────────
    // توجيه حسب الدور
    // ─────────────────────────────────────────
    private function redirectByRole(User $user): \Illuminate\Http\RedirectResponse
    {
        return match($user->role) {
            'super_admin' => redirect()->route('admin.dashboard'),
            'doctor'      => redirect()->route('doctor.dashboard'),
            default       => redirect()->route('login'),
        };
    }
}