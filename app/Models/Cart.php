<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\myServiceLevelTow;
class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    protected $guarded = [];


    function user() {
        return $this->belongsTo(User::class);
    }
    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += array_sum($item->quantities) * $item->product->price;
        }

        return $totalPrice;
    }
    public function service()
    {
        return $this->belongsTo(myServiceLevelTow::class, );
    }
    // protected $casts = [
    //     'quantities' => 'array', // Field name to store the array
    // ];
}
