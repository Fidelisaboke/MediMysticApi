<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrugCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 6 categories
        $categories = [
            ['category_name' => 'painkiller'],
            ['category_name' => 'vaccine'],
            ['category_name' => 'antibiotic'],
            ['category_name' => 'antiviral'],
            ['category_name' => 'antifungal'],
            ['category_name' => 'antidepresant']
        ];

        foreach ($categories as $category) {
            \App\Models\DrugCategory::create($category);
        }
    }
}
