<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudy;

class ProgramStudySeeder extends Seeder
{
    public function run(): void
    {
        $studies = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Magister Ilmu Komputer'
        ];

        foreach ($studies as $study) {
            ProgramStudy::create(['name' => $study]);
        }
    }
}
