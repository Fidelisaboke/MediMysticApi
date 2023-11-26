<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Drug;
use Illuminate\Support\Carbon;  

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 10 Drugs:
        // Generate 10 records with random data
        for ($i = 1; $i <= 10; $i++) {
            Drug::create([
                'trade_name' => 'Drug' . $i,
                'drug_formula' => 'Formula' . $i,
                'category' => $i % 2 == 0 ? 'painkiller': 'vaccine',
                'quantity' => rand(50, 200),
                'dosage_mg' => rand(10, 100),
                'expiry_date' => Carbon::now()->addMonths(rand(1, 12))->toDateString(),
            ]);
        }
    }
}
