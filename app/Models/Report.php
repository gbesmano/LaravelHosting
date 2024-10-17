<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'review_id',
        'destination_id',
        'reason',
        'others',
        'status',
    ];
    protected $casts = [
        '_id' => 'string',
        'user_id' => 'string',
    ];
    public function destination() {
        return $this->belongsTo(Destination::class, 'destination_id');
    }

    public function review() {
        return $this->belongsTo(Review::class, 'review_id');
    }
}
