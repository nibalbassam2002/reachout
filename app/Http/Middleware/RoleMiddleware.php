<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * يُنفَّذ عند كل طلب يمر بهذا الـ middleware
     * الاستخدام في routes: middleware('role:super_admin')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        /** @var User $user */
        $user = auth()->user();

        if ($user->role !== $role) {
            $route = $user->role === 'super_admin'
                ? 'admin.dashboard'
                : 'doctor.dashboard';

            return redirect()->route($route);
        }

        return $next($request);
    }
}