<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use App\Models\LetterType;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        switch ($user->role->id) {
            case 1: // Admin
                return view('dashboard.admin');
            case 2: // Mahasiswa
                return view('dashboard.student');
            case 3: // Kaprodi
                return view('dashboard.kaprodi');
            case 4: // Manajer Operasional
                return view('dashboard.manager');
            default:
                abort(403, 'Unauthorized');
        }
    }
}
