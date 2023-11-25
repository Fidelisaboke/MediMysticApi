<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 10 users:
        // Generate 10 records with random data
        for ($i = 1; $i <= 10; $i++) {
            DB::table('clients')->insert([
                'name' => 'Client' . $i,
                'email' => 'client' . $i . '@example.com',
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'password' => Hash::make('password' . $i),
                'last_login_at' => now(),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
