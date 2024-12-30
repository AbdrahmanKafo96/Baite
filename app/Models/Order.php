<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $guarded = [];

     protected $casts = [
        'service_seclected' => 'array', // Field name to store the array
        'quantity_selected' => 'array', // Field name to store the array
    ];
}
