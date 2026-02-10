<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@campus.ac.id', // Email Login Admin
            'password' => Hash::make('admin123'), // Password Admin
            'role' => 'admin'
        ]);

        // 2. Buat Akun KETUA JURUSAN
        User::create([
            'name' => 'Bapak Ketua Jurusan',
            'email' => 'ketuajurusan@campus.ac.id', // Email Login Ketua
            'password' => Hash::make('ketua123'), // Password Ketua
            'role' => 'ketua'
        ]);
    }
}