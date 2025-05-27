<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::insert([
            [
                'name' => 'Seminar Nasional AI',
                'tanggal' => '2025-06-10',
                'waktu' => '09:00',
                'lokasi' => 'Auditorium Universitas',
                'narasumber' => 'Dr. Techno AI',
                'poster' => 'seminar_ai.jpg',
                'biaya' => 50000,
                'max_peserta' => 200
            ],
            [
                'name' => 'Workshop IoT Dasar',
                'tanggal' => '2025-07-01',
                'waktu' => '13:00',
                'lokasi' => 'Lab IoT',
                'narasumber' => 'Ir. IoT Pro',
                'poster' => 'workshop_iot.jpg',
                'biaya' => 75000,
                'max_peserta' => 100
            ]
        ]);
    }
}
