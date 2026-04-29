<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'owner_name',
        'inn',
        'email',
        'phone',
        'telegram',
        'address',
    ];
}
