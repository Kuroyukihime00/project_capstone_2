<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventSession;

class AdminEventSessionController extends Controller
{
    public function index()
    {
        $sessions = EventSession::with('event')->latest()->get();
        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $events = Event::all();
        return view('admin.sessions.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'title' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        EventSession::create($request->all());
        return redirect()->route('admin.sessions.index')->with('success', 'Sesi berhasil ditambahkan.');
    }
}
