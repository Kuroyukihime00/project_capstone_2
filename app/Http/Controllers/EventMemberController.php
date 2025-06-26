<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventMemberController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function register(Event $event)
    {
        // Load sessions dari event
        $event->load('sessions');

        // Cek apakah user sudah terdaftar di event ini
        $existing = EventRegistration::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->first();

        $qrData = null;

        if ($existing) {
            // Buat QR code jika sudah terdaftar
            $qr = QrCode::format('png')->size(250)->generate($existing->id);
            $qrData = 'data:image/png;base64,' . base64_encode($qr);
        }

        return view('member.events.register', compact('event', 'existing', 'qrData'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'session_id' => 'required|exists:event_sessions,id',
        ]);

        $registration = new \App\Models\EventRegistration();
        $registration->user_id = auth()->id();
        $registration->event_id = $event->id;
        $registration->session_id = $request->session_id;
        $registration->status = 'waiting';
        $registration->save();

        return redirect()->route('member.dashboard')->with('success', 'Registrasi berhasil.');
    }
}
