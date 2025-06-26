<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class MemberCertificateController extends Controller
{
    public function show()
    {
        $certificates = Certificate::with(['registration.event'])
            ->whereHas('registration', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        return view('member.certificates.index', compact('certificates'));
    }

    public function download($registrationId)
    {
        $cert = Certificate::where('event_registration_id', $registrationId)->firstOrFail();
        return response()->download(storage_path('app/public/' . $cert->file_path));
    }
}
