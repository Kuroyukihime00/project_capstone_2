<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use App\Models\EventRegistration;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil satu registrasi sebagai contoh
        $registration = EventRegistration::first();

        if ($registration) {
            Certificate::create([
                'event_registration_id' => $registration->id,
                'file_path' => 'certificates/sample_certificate.pdf',
            ]);
        }
    }
}
