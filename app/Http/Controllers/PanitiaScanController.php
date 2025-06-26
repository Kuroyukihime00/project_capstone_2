<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\Attendance;

class PanitiaScanController extends Controller
{
    public function index()
    {
        $registrations = \App\Models\EventRegistration::with(['user', 'event', 'session'])->latest()->get();
        return view('panitia.scan.index', compact('registrations'));
    }

    public function scan($registrationId)
    {
        $registration = EventRegistration::with(['user', 'event', 'session'])->findOrFail($registrationId);

        // Catat kehadiran jika belum ada
        Attendance::firstOrCreate([
            'event_registration_id' => $registration->id
        ]);

        return view('panitia.scan.show', compact('registration'));
    }

    public function showForm()
    {
        return view('panitia.scan.form');
    }

    public function handleScan(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:event_registrations,id',
        ]);

        $registration = EventRegistration::with(['user', 'event', 'session'])->find($request->registration_id);

        // Catat kehadiran
        Attendance::firstOrCreate([
            'event_registration_id' => $registration->id
        ]);

        return redirect()->back()->with('success', 'Scan berhasil. Peserta telah dicatat hadir: ' . $registration->user->name);
    }
}
