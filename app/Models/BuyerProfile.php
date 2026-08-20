<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BuyerProfile extends Model
{

    use HasFactory;




    protected $fillable = [

        'user_id',

        'company_name',

        'phone',

        'requirements',

        'province',

        'city',

        'status',

    ];







    protected function casts(): array
    {
        return [

            'status' => 'string',

        ];
    }









    /*
    |--------------------------------------------------------------------------
    | Status Constants
    |--------------------------------------------------------------------------
    */



    public const STATUS_PENDING = 'pending';


    public const STATUS_ACTIVE = 'active';


    public const STATUS_INACTIVE = 'inactive';









    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */



    public function user()
    {
        return $this->belongsTo(User::class);
    }









    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */



    public function scopeActive($query)
    {
        return $query->where(

            'status',

            self::STATUS_ACTIVE

        );
    }







    public function scopePending($query)
    {
        return $query->where(

            'status',

            self::STATUS_PENDING

        );
    }







    public function scopeInactive($query)
    {
        return $query->where(

            'status',

            self::STATUS_INACTIVE

        );
    }


}
