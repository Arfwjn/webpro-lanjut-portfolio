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
        // Email: ariefsidik2016@gmail.com | Password: arfwjn123
        User::firstOrCreate(
            ['email' => 'ariefsidik2016@gmail.com'],
            [
                'name'              => 'Arief Sidik Wijayanto',
                'password'          => Hash::make('arfwjn123'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user dibuat: ariefsidik2016@gmail.com / arfwjn123');
        $this->command->warn(' Segera ganti password setelah login pertama!');
    }
}