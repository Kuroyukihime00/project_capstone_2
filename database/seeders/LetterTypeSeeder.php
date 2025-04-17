<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LetterType;

class LetterTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Surat Keterangan Mahasiswa Aktif',
            'Surat Pengantar Tugas Mata Kuliah',
            'Surat Keterangan Lulus',
            'Laporan Hasil Studi'
        ];

        foreach ($types as $type) {
            LetterType::create(['name' => $type]);
        }
    }
}
