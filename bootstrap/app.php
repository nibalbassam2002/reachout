<?php
// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth; // <-- مهم جداً لإستخدام Auth

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // 1. تسجيل الـ RoleMiddleware (الكود القديم الخاص بك)
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // 2. الحل: تحديد التوجيه للمستخدمين المسجلين دخولهم
        $middleware->redirectUsersTo(function () {
            $user = Auth::user();

            if ($user) {
                // إذا كان سوبر أدمن، وجهه لداشبورد الأدمن
                if ($user->role === 'super_admin') {
                    return route('admin.dashboard');
                }
                
                // إذا كان دكتور، وجهه لداشبورد الدكتور
                if ($user->role === 'doctor') {
                    return route('doctor.dashboard');
                }
            }

            // الافتراضي في حال لم يكن أي مما سبق
            return '/'; 
        });

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();