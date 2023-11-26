<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("drug_category_id")->index()->constrained("drug_categories");
            $table->string("trade_name");
            $table->string("drug_formula");
            $table->integer("quantity")->unsigned();
            $table->integer("dosage_mg")->unsigned();
            $table->decimal("drug_price", 8, 2);
            $table->date("expiry_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
