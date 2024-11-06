<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_name',
        'email',
        'pet_name',
        'phone_no',
        'indate',
        'outdate',
        'pet_behavior',
        'payment_status',
        'package_details',
    ];
    protected $hidden = [
        '',
    ];
}
