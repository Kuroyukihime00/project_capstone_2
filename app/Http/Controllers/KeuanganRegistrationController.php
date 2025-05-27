<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use Illuminate\Http\Request;

class KeuanganRegistrationController extends Controller
{
    public function verify(EventRegistration $registration)
    {
        $registration->update(['status' => 'paid']);

        return redirect()->route('keuangan.dashboard')->with('success', 'Pembayaran diverifikasi.');
    }
}
