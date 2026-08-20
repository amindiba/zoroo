<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;




    protected $fillable = [

        'user_id',

        'category_id',

        'name',

        'description',

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


    public const STATUS_APPROVED = 'approved';









    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */



    public function user()
    {
        return $this->belongsTo(User::class);
    }






    public function category()
    {
        return $this->belongsTo(Category::class);
    }









    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */



    public function scopeApproved($query)
    {
        return $query->where(

            'status',

            self::STATUS_APPROVED

        );
    }







    public function scopePending($query)
    {
        return $query->where(

            'status',

            self::STATUS_PENDING

        );
    }







    public function scopeActive($query)
    {
        return $query->where(

            'status',

            self::STATUS_ACTIVE

        );
    }







    public function scopeInactive($query)
    {
        return $query->where(

            'status',

            self::STATUS_INACTIVE

        );
    }







    public function scopeLatestProducts($query)
    {
        return $query

            ->latest()

            ->limit(5);
    }


}
