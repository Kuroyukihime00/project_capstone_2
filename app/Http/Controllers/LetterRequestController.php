<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\LetterRequest;
use App\Models\LetterType;
use Illuminate\Http\Request;

class LetterRequestController extends Controller
{
    public function index()
    {
        $student = Student::where('nrp', auth()->user()->nip)->first();
    
        if (!$student) {
            return back()->withErrors(['Data mahasiswa tidak ditemukan.']);
        }
    
        $requests = LetterRequest::with('letterType')
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('letter_requests.index', compact('requests'));
    }

    public function create()
    {
        $types = LetterType::all(); // Ambil semua jenis surat
        return view('letter_requests.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'letter_type_id' => 'required|exists:letter_types,id',
            'reason' => 'required|string|max:255',
        ]);

        // Ambil student berdasarkan NIP user login
        $student = Student::where('nrp', auth()->user()->nip)->first();

        if (!$student) {
            return back()->withErrors(['Mahasiswa tidak ditemukan.']);
        }

        LetterRequest::create([
            'student_id' => $student->id,
            'letter_type_id' => $validated['letter_type_id'],
            'description' => $validated['reason'],
            'status' => 'pending',
        ]);
        
        return redirect()->route('student.letter-requests.index')->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    public function show($id)
    {
        $letterRequest = LetterRequest::with('letterType')->findOrFail($id);
        return view('letter_requests.show', compact('letterRequest'));
    }    

    public function edit($id)
    {
        // Form edit pengajuan surat
        return view('letter_requests.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update pengajuan surat
    }

    public function destroy($id)
    {
        $request = LetterRequest::findOrFail($id);
        $request->delete();
    
        return redirect()->route('student.letter-requests.index')->with('success', 'Pengajuan surat berhasil dihapus.');
    }
        
    public function letterType()
    {
        return $this->belongsTo(LetterType::class);
    }
}
