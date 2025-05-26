<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
public function handle($request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    if (!in_array($user->role, $roles)) {
        // Optional: Redirect based on role
        if ($user->role === 'member') {
            return redirect()->route('member.mem-dashboard');
        }

        // Default fallback (unauthorized for other roles)
        abort(403, 'Unauthorized');
    }

    return $next($request);
}

}