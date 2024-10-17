<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'designated_locality',
        'vehicle',
        'operating_hours',
        'distance',
        'initial_fare',
        'additional_fare',
        'discounted_fare',
    ];
}
