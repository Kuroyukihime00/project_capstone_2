<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\Attendance;

class PanitiaScanController extends Controller
{
    public function scan($registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);

        Attendance::firstOrCreate([
            'event_registration_id' => $registration->id
        ]);

        return redirect()->route('panitia.dashboard')->with('success', 'Peserta berhasil dicatat hadir.');
    }
}
