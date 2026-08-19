<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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





    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
