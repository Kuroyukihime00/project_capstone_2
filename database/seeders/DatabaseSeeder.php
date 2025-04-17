<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            LetterTypeSeeder::class,
            ProgramStudySeeder::class,
        ]);

        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'nip' => '1234567',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Mahasiswa Satu',
            'email' => 'mahasiswa@example.com',
            'nip' => '2200001',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        // Kaprodi
        User::create([
            'name' => 'Kaprodi Satu',
            'email' => 'kaprodi@example.com',
            'nip' => '3300001',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);

        // Manajer Operasional
        User::create([
            'name' => 'Manajer TU',
            'email' => 'manajer@example.com',
            'nip' => '4400001',
            'password' => Hash::make('password'),
            'role_id' => 4,
        ]);
    }
}
