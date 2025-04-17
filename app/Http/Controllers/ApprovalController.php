<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        $requests = LetterRequest::with(['student.user', 'letterType'])
            ->where('status', 'pending')
            ->get();
    
        return view('approvals.index', compact('requests'));
    }

    public function show($id)
    {
        $request = LetterRequest::with(['student.user', 'letterType'])->findOrFail($id);
        return view('approvals.show', compact('request'));
    }    

    public function approve($id)
    {
        $request = LetterRequest::findOrFail($id);
        $request->status = 'approved';
        $request->save();
    
        return redirect()->route('approvals.index')->with('success', 'Surat telah disetujui!');
    }
        
    public function reject(Request $request, $id)
    {
        $letter = LetterRequest::findOrFail($id);
        $letter->status = 'rejected';
        $letter->rejection_reason = $request->input('rejection_reason');
        $letter->save();
    
        return redirect()->route('approvals.index')->with('success', 'Surat telah ditolak!');
    }        
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'user_nip', 'nrp');
    }    
}
