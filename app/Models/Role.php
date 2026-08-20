<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{

    use HasFactory;




    protected $fillable = [

        'name',

        'slug',

    ];








    /*
    |--------------------------------------------------------------------------
    | Role Constants
    |--------------------------------------------------------------------------
    */


    public const ADMIN = 'admin';


    public const PRODUCER = 'producer';


    public const BUYER = 'buyer';









    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */



    public function users()
    {
        return $this->hasMany(User::class);
    }









    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */



    public function scopeAdmin($query)
    {
        return $query->where(

            'slug',

            self::ADMIN

        );
    }







    public function scopeProducer($query)
    {
        return $query->where(

            'slug',

            self::PRODUCER

        );
    }







    public function scopeBuyer($query)
    {
        return $query->where(

            'slug',

            self::BUYER

        );
    }


}
