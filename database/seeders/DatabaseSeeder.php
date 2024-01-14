<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Alec Thompson',
            'username' => 'Alec-123',
            'email' => 'alec123_@gmail.com',
            'password' => Hash::make('alec123_'),
            'confirm_password' => Hash::make('alec123_'),
            'level' => 'Karyawan',
        ]);
        User::factory()->create([
            'name' => 'Subakti Wirawan Putra',
            'username' => 'Putra_11Wi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123_'),
            'confirm_password' => Hash::make('admin123_'),
            'level' => 'Admin',
        ]);
    }
}
