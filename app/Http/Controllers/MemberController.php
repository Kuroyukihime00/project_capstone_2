<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'sessions' => 'required|array',
            'sessions.*' => 'exists:event_sessions,id',
        ]);

        $registration = EventRegistration::create([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
            'status' => 'belum', // default status pembayaran
        ]);

        $registration->sessions()->attach($request->sessions); // simpan kehadiran per sesi

        return redirect()->route('member.payments.index')->with('success', 'Berhasil daftar event, silakan lakukan pembayaran.');
    }
}
