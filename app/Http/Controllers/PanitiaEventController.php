<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class PanitiaEventController extends Controller
{
    /**
     * Tampilkan form untuk membuat event.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Simpan event baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required|string|max:100',
            'narasumber' => 'required|string|max:100',
            'poster' => 'nullable|string|max:255',
            'biaya' => 'required|numeric|min:0',
            'max_peserta' => 'required|integer|min:1',
        ]);

        Event::create([
            'name' => $request->name,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'narasumber' => $request->narasumber,
            'poster' => $request->poster,
            'biaya' => $request->biaya,
            'max_peserta' => $request->max_peserta,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('panitia.events.index')->with('success', 'Event berhasil ditambahkan.');
    }
}
