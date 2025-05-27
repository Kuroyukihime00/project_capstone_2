<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\Payment;

class MemberPaymentController extends Controller
{
    public function create(EventRegistration $registration)
    {
        return view('memberpayment.create', compact('registration'));
    }

    public function store(Request $request, EventRegistration $registration)
    {
        $validated = $request->validate([
            'proof' => 'required|image|max:2048',
        ]);

        $path = $request->file('proof')->store('payment_proofs', 'public');

        Payment::create([
            'event_registration_id' => $registration->id,
            'proof_path' => $path,
            'status' => 'waiting',
        ]);

        $registration->update(['status' => 'paid']);

        return redirect()->route('member.dashboard')->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
}
