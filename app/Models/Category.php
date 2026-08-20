<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;




    protected $fillable = [

        'name',

        'slug',

        'parent_id',

        'description',

        'status',

    ];






    protected function casts(): array
    {
        return [

            'status' => 'boolean',

        ];
    }








    /*
    |--------------------------------------------------------------------------
    | Status Constants
    |--------------------------------------------------------------------------
    */


    public const STATUS_ACTIVE = true;


    public const STATUS_INACTIVE = false;









    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */



    public function products()
    {
        return $this->hasMany(Product::class);
    }







    public function parent()
    {
        return $this->belongsTo(

            Category::class,

            'parent_id'

        );
    }







    public function children()
    {
        return $this->hasMany(

            Category::class,

            'parent_id'

        );
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







    public function scopeRoot($query)
    {
        return $query->whereNull(

            'parent_id'

        );
    }







    public function scopeChildren($query)
    {
        return $query->whereNotNull(

            'parent_id'

        );
    }


}
