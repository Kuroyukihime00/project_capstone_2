<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRole
{
    public function handle($request, Closure $next, $role)
    {
        $userRole = auth()->user()->role->name; // Atau gunakan `role_id` jika lebih aman
        if ($userRole !== $role) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }    
}
