<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanitiaEventSessionController extends Controller
{
    public function index()
    {
        $events = Event::with('sessions')->where('created_by', auth()->id())->get();
        return view('panitia.sessions.index', compact('events'));
    }

    public function create(Event $event)
    {
        // hanya boleh buat sesi kalau event ini milik dia
        abort_if($event->created_by !== auth()->id(), 403);
        return view('panitia.sessions.create', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'title' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        $event = Event::findOrFail($request->event_id);
        if ($event->created_by !== auth()->id()) {
            abort(403);
        }

        Session::create([
            'event_id' => $request->event_id,
            'title' => $request->title,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('panitia.sessions.index')->with('success', 'Sesi berhasil ditambahkan');
    }
}
