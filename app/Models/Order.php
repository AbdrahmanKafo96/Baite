<?php

namespace App\Models;

use Database\Seeders\MyServiceLevelTowSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'service_seclected' => 'json', // Field name to store the array
       // 'quantity_selected' => 'array', // Field name to store the array
    ];
    // public function service()
    // {
    //     return $this->belongsTo(myServiceLevelTow::class, );
    // }
    public function service()
    {
        return $this->belongsTo(myServiceLevelTow::class,'service_seclected','id');
    }
}
