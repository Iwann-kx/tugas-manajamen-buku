<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => 'admin123',
            ]
        );
        $admin->syncRoles(['Admin']);

        $dosen = User::updateOrCreate(
            ['email' => 'dosen@gmail.com'],
            [
                'name' => 'Dosen',
                'password' => 'dosen123',
            ]
        );
        $dosen->syncRoles(['Dosen']);

        $mahasiswa = User::updateOrCreate(
            ['email' => 'mahasiswa@gmail.com'],
            [
                'name' => 'Mahasiswa',
                'password' => 'mahasiswa123',
            ]
        );
        $mahasiswa->syncRoles(['Mahasiswa']);
    }
}
