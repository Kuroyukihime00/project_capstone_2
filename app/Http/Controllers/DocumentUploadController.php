<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use App\Models\UploadedDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentUploadController extends Controller
{
    public function index()
    {
        // Menampilkan daftar surat yang disetujui dan belum diupload
        $requests = LetterRequest::where('status', 'approved')
            ->doesntHave('uploadedDocument')
            ->get();

        return view('uploads.index', compact('requests'));
    }

    public function uploadForm($id)
    {
        $request = LetterRequest::findOrFail($id);
        return view('uploads.upload', compact('request'));
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'document' => 'required|mimes:pdf|max:2048',
        ]);

        $letterRequest = LetterRequest::findOrFail($id);
        $file = $request->file('document');
        $path = $file->store('documents', 'public');

        UploadedDocument::create([
            'letter_request_id' => $letterRequest->id,
            'file_path' => $path,
        ]);

        return redirect()->route('uploads.index')->with('success', 'Dokumen berhasil diunggah.');
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);
    
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/uploads', $filename);
    
        UploadedDocument::create([
            'letter_request_id' => $id,
            'file_path' => $filename,
        ]);
    
        return redirect()
            ->route('uploads.index')
            ->with([
                'success' => 'Surat berhasil diunggah!',
                'download' => asset('storage/uploads/' . $filename),
            ]);
    }
}
