<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin user untuk login ke dashboard
        // Email: admin@portfolio.com | Password: password
        User::firstOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name'              => 'Admin Portfolio',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user dibuat: admin@portfolio.com / password');
        $this->command->warn(' Segera ganti password setelah login pertama!');
    }
}