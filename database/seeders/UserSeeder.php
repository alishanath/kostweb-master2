<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'adminkost1@gmail.com',
            'username' => 'admin1',
            'tanggal_lahir' => '2001-06-20',
            'no_hp' => '089630433177',
            'alamat' => 'Jl. Sunan Kalijaga No. 21',
            'role' => 'admin',
            'password' => Hash::make('admin1'), // Ganti dengan password aman!
        ]);

        User::create([
            'name' => 'Admin Cadangan',
            'email' => 'adminkost2@gmail.com',
            'username' => 'admin2',
            'tanggal_lahir' => '2007-03-09',
            'no_hp' => '089630433177',
            'alamat' => 'Jl. Sunan Ampel No. 22',
            'role' => 'admin',
            'password' => Hash::make('admin2'), // Ganti dengan password aman!
        ]);

        User::create([
            'name' => 'Penghuni Satu',
            'email' => 'penghuni@example.com',
            'username' => 'penghuni1',
            'no_hp' => '082233445566',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Kosan A No. 3',
            'role' => 'penghuni',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'username' => 'user123',
            'no_hp' => '081122334455',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Jl. Umum No. 10',
            'role' => 'user',
            'password' => Hash::make('12345678'),
        ]);
    }
}
