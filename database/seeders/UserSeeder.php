<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = DB::table('roles')->pluck('id', 'name');

        User::insert([
            [
                'name' => 'Admin Demo',
                'email' => 'admin@demo.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['admin'],
            ],
            [
                'name' => 'Member Demo',
                'email' => 'member@demo.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['member'],
            ],
            [
                'name' => 'Panitia Demo',
                'email' => 'panitia@demo.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['panitia'],
            ],
            [
                'name' => 'Keuangan Demo',
                'email' => 'keuangan@demo.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['keuangan'],
            ],
        ]);
    }
}
