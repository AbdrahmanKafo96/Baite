<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User  ;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\Access\Authorizable;             // <-- add import
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperAdmin extends Authenticatable
    {
        use HasFactory,
            // HasRoles,
            Notifiable,
            HasApiTokens,
            Authorizable;

        protected $guarded = [];
        protected $guard_name =  'admins';



        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
            'email_verified_at',
            'remember_token',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'email_verified_at' => 'datetime', ];

}
