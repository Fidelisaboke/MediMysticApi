<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 3 invoices for clients (today's date)
        for($i = 1; $i <= 3; $i++) {
            Invoice::create([
                "client_id" => rand(1, 5),
                "drug_id" => rand(1, 5),
                "invoice_date" => now()->toDateString()
            ]);
        }

        // Create 3 invoices for clients (yesterday's date)
        for($i = 1; $i <= 3; $i++) {
            Invoice::create([
                "client_id" => rand(1, 5),
                "drug_id" => rand(1, 5),
                "invoice_date" => now()->subDay()->toDateString()
            ]);
        }
    }
}
