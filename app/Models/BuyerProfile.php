<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'phone',
        'requirements',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
