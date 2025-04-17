<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) return redirect('/login');

        switch ($user->role->name) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'mahasiswa':
                return redirect()->route('student.dashboard');
            case 'kaprodi':
                return redirect()->route('kaprodi.dashboard');
            case 'manajer':
                return redirect()->route('manager.dashboard');
            default:
                return redirect('/dashboard');
        }
    }
}
