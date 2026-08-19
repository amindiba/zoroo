<?php

namespace App\Models;

use App\Models\Role;
use App\Models\ProducerProfile;
use App\Models\BuyerProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [

        'name',

        'email',

        'password',

        'role_id',

    ];



    protected $hidden = [

        'password',

        'remember_token',

    ];



    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

        ];
    }



    public function role()
    {
        return $this->belongsTo(Role::class);
    }



    public function producerProfile()
    {
        return $this->hasOne(ProducerProfile::class);
    }



    public function buyerProfile()
    {
        return $this->hasOne(BuyerProfile::class);
    }
}
