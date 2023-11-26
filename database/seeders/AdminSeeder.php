<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 5 admin records
        Admin::create([
            'name' => 'Admin One',
            'email' => 'admin1@email.com',
            'password' => Hash::make('123'),
        ]);
    }
}
