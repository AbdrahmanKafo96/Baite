<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User  ;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\Access\Authorizable;             // <-- add import
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    use HasFactory,
        // HasRoles,
        Notifiable,
        HasApiTokens,
        Authorizable;

    protected $guarded = [];
    protected $guard_name =  'client_api';
    protected $hidden = [
        'password',
        'email_verified_at',
    ];
}
