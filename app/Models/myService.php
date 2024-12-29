<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class MyService extends Model
{
    /** @use HasFactory<\Database\Factories\MyServiceFactory> */
    use HasFactory , HasApiTokens;
    protected $guarded = [];
}
