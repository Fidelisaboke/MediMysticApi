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
        // Generate 10 drugs with random data
        for ($i = 1; $i <= 10; $i++) {
            Drug::create([
                'drug_category_id' => rand(1, 3),
                'trade_name' => 'Drug' . $i,
                'drug_formula' => 'Formula' . $i,
                'quantity' => rand(50, 200),
                'dosage_mg' => rand(10, 100),
                'drug_price' => rand(100, 1000),
                'expiry_date' => Carbon::now()->addMonths(rand(1, 12))->toDateString(),
            ]);
        }
    }
}
