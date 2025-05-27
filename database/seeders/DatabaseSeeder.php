<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed roles
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'member'],
            ['name' => 'panitia'],
            ['name' => 'keuangan'],
        ]);

        // Ambil ID role berdasarkan nama
        $roles = DB::table('roles')->pluck('id', 'name');

        // Seed users
        User::insert([
            [
                'name' => 'Admin Demo',
                'email' => 'admin@demo.com',
                'nip' => '1000001',
                'password' => Hash::make('password'),
                'role_id' => $roles['admin'],
            ],
            [
                'name' => 'Member Demo',
                'email' => 'member@demo.com',
                'nip' => '1000002',
                'password' => Hash::make('password'),
                'role_id' => $roles['member'],
            ],
            [
                'name' => 'Panitia Demo',
                'email' => 'panitia@demo.com',
                'nip' => '1000003',
                'password' => Hash::make('password'),
                'role_id' => $roles['panitia'],
            ],
            [
                'name' => 'Keuangan Demo',
                'email' => 'keuangan@demo.com',
                'nip' => '1000004',
                'password' => Hash::make('password'),
                'role_id' => $roles['keuangan'],
            ],
        ]);

        // Panggil seeder tambahan
        $this->call([
            \Database\Seeders\EventSeeder::class,
            \Database\Seeders\CertificateSeeder::class,
        ]);
    }
}
