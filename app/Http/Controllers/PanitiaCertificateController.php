<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PanitiaCertificateController extends Controller
{
    public function qr($registrationId)
    {
        $registration = \App\Models\EventRegistration::with(['user', 'event'])->findOrFail($registrationId);
        $qr = QrCode::format('png')->size(250)->generate(route('member.certificates.download', $registration->id));
        $qrData = 'data:image/png;base64,' . base64_encode($qr);

        return view('panitia.certificate.qr', compact('registration', 'qrData'));
    }
}
