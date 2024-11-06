<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Dog extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'dogs'; // Specify the table name if it's not the plural form
    protected $fillable = [
        'ownername',
        'email',
        'dogname',
        'dogbirthday',
        'password',
        'dogdetail',
    ];
    protected $hidden = [
        'password',
    ];

    // If you want to use timestamps
    public $timestamps = false; // Set to true if your table uses created_at and updated_at
}
