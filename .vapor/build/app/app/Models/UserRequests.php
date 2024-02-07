<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequests extends Model
{
    use HasFactory;

    protected $table = "UserRequests";

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
    
    //define relationship with user model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id'); 
    }

}

