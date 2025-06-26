<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use App\Models\EventRegistrationSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberEventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'sessions' => 'required|array',
            'sessions.*' => 'exists:event_sessions,id',
        ]);

        $userId = auth()->id();

        // Cek apakah sudah terdaftar sebelumnya
        $existing = EventRegistration::where('event_id', $request->event_id)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Kamu sudah mendaftar untuk event ini.');
        }

        DB::beginTransaction();
        try {
            // Simpan registrasi event
            $registration = EventRegistration::create([
                'user_id' => $userId,
                'event_id' => $request->event_id,
                'status' => 'belum', // default status pembayaran
            ]);

            // Simpan sesi-sesi yang dipilih ke pivot table
            foreach ($request->sessions as $sessionId) {
                EventRegistrationSession::create([
                    'event_registration_id' => $registration->id,
                    'event_session_id' => $sessionId,
                    'attended' => false,
                ]);
            }

            DB::commit();
            return redirect()->route('member.dashboard')->with('success', 'Registrasi berhasil. Silakan lanjut ke pembayaran.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat registrasi.');
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }
}
