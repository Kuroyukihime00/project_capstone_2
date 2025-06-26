<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberPaymentController extends Controller
{
    // Menampilkan form upload bukti pembayaran untuk event yang telah didaftarkan
    public function create()
    {
        $registrations = EventRegistration::with('event')
            ->where('user_id', Auth::id())
            ->whereNull('payment_proof_path') // hanya yang belum upload
            ->get();

        return view('member.payments.upload', compact('registrations'));
    }

    // Menyimpan bukti pembayaran
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_registration_id' => 'required|exists:event_registrations,id',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $registration = EventRegistration::where('id', $validated['event_registration_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $registration->update([
            'payment_proof_path' => $path,
            'payment_status' => 'proses',
        ]);

        return redirect()->route('member.payments.create')
            ->with('success', 'Bukti pembayaran berhasil diunggah dan sedang diproses.');
    }
}
