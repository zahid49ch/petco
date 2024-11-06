<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SpendsReportController;

class Spend extends Model
{
    protected $fillable = [
        'check_in_date',
        'description',
        'amount',
    ];
}
