<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = "inventory";

    protected $fillable = [
        'school_property',
        'property_number',
        'unit_of_measure',
        'unit_value',
        'quantity_per_property',
        'quantity_per_physical',
        'quantity',
        'value',
        'total_value',
        'remarks',
        'category',
        'item_purchased_through_MOOE',
        'donation',
        'grade_level'
    ];

    // Define relationships if applicable
    // public function category() {
    //     return $this->belongsTo(Category::class);
    // }
}