<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;
use App\Models\Destination;

class Review extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'destination_id',
        'user_id',
        'rating',
        'review_title',
        'comment',
        'date',
        'proof',
        'status',
    ];  
      protected $casts = [
        '_id' => 'string',
        'user_id' => 'string',
        'destination_id' => 'string',
    ];

    public function report()
    {
        return $this->hasMany(Report::class);
    }

    public function destination() {
        return $this->belongsTo(Destination::class, 'destination_id', '_id');
    }
    
    
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
    
    
}
