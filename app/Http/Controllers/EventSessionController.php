<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventSession;

class EventSessionController extends Controller
{
    /**
     * Tampilkan form tambah sesi untuk suatu event.
     */
    public function create(Event $event)
    {
        return view('sessions.create', compact('event'));
    }

    /**
     * Simpan sesi baru untuk event.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        EventSession::create([
            'event_id' => $event->id,
            'title' => $request->title,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('panitia.dashboard')->with('success', 'Sesi event berhasil ditambahkan.');
    }
}
