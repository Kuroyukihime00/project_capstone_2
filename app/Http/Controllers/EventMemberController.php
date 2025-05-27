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
        $registration = EventRegistration::firstOrCreate([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
        ], ['status' => 'pending']);

        $qr = QrCode::format('png')->size(250)->generate($registration->id);
        $qrData = 'data:image/png;base64,' . base64_encode($qr);

        return view('events.register', compact('event', 'qrData'))->with('qr', $qrData);
    }
}
