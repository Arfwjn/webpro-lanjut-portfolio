<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{    
    public function run(): void
    {
        // Buat admin user pertama untuk akses dashboard admin
        User::firstOrCreate(
            ['email' => 'ariefsidik2016@gmail.com'],
            [
                'name'              => 'Arief Sidik Wijayanto',
                'password'          => Hash::make('arfwjn123'),
                'email_verified_at' => now(),
            ]
        );

$this->command->info('Admin user berhasil dibuat!');
        $this->command->warn('Segera ganti password setelah login pertama kali!');
    }
}