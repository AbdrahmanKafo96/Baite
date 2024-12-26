<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class myServiceLevelOne extends Model
{
    /** @use HasFactory<\Database\Factories\MyServiceLevelOneFactory> */
    use HasFactory, HasApiTokens;
    protected $guarded = [];
}
