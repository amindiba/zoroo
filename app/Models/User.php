<?php

namespace App\Models;

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









    /*
    |--------------------------------------------------------------------------
    | Role Constants
    |--------------------------------------------------------------------------
    */


    public const ROLE_ADMIN = 'admin';


    public const ROLE_PRODUCER = 'producer';


    public const ROLE_BUYER = 'buyer';









    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */



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







    public function products()
    {
        return $this->hasMany(Product::class);
    }









    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */



    public function hasRole(string $role): bool
    {
        return $this->role?->slug === $role;
    }







    public function isAdmin(): bool
    {
        return $this->hasRole(

            self::ROLE_ADMIN

        );
    }







    public function isProducer(): bool
    {
        return $this->hasRole(

            self::ROLE_PRODUCER

        );
    }







    public function isBuyer(): bool
    {
        return $this->hasRole(

            self::ROLE_BUYER

        );
    }


}
