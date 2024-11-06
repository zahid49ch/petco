<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroomingTracking extends Model
{
    use HasFactory;

    protected $table = 'grooming_tracking'; // Name of the table in the database

    protected $fillable = [
        'owner_id',
        'step',
    ];

    // Define relationship with Dog model
    public function dog()
    {
        return $this->belongsTo(Dog::class, 'owner_id');
    }
}
