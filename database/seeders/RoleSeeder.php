<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['name' => 'admin'],
            ['name' => 'mahasiswa'],
            ['name' => 'kaprodi'],
            ['name' => 'manajer'],
        ]);
    }
}
