<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request_history extends Model
{
    use HasFactory;

    protected $table = "request_history";

    protected $fillable = [
        'user_id',
        'inventory_id',
        'status',
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
        'acquisition_type',
        'grade_level',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id'); 
    }



}