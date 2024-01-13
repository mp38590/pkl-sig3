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
            'email' => 'admin@corporateui.com',
            'password' => Hash::make('secret'),
            'confirm_password' => Hash::make('secret'),
            'level' => 'Karyawan',
        ]);
    }
}
