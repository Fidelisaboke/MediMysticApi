<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $fillable = [
        'drug_category_id',
        'trade_name', 
        'drug_formula', 
        'category', 
        'quantity', 
        'dosage_mg', 
        'drug_price',
        'expiry_date'
    ];
}
