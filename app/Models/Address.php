<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'pin_code',
        'address',
        'street_address',
        'city',
        'user_id'
    ];
}
