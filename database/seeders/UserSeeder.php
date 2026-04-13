<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PembimbingProfile;
use App\Models\UserProfile;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        $admin = User::create([
            'name'      => 'Admin Utama',
            'email'     => 'admin@example.com',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
            'gender'    => 'L',
            'tgl_lahir' => '1985-01-01',
            'alamat'    => 'Jl. Kantor Pusat No.1',
            'no_hp'     => '08111111111',
            'foto'      => null,
        ]);
    }
}
