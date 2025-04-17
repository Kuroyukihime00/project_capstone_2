<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $role = Auth::user()->role->name;
    
            return match ($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'mahasiswa' => redirect()->route('student.dashboard'),
                'kaprodi' => redirect()->route('kaprodi.dashboard'),
                'manajer' => redirect()->route('manager.dashboard'),
                default => redirect('/login')
            };
        }
    
        return $next($request);
    }    
}
