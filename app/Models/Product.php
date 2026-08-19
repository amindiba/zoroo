<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [

        'user_id',

        'name',

        'description',

        'category',

        'province',

        'city',

        'status',

    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
