<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'status', 'type','amount']; // Add 'type' if needed to differentiate between hostel, daycare, and grooming

}


