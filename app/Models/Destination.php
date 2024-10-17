<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'company_name',
        'company_address',
        'about',
        'company_permit',
        'location_clearance',
        'barangay_clearance',
        'philhealth',
        'corporate_bank_account',
        'sec_registration',
        'tin',
        'sss',
        'destination_name',
        'category',
        'operating_hours',
        'destination_address',
        'locality',
        'nearest_landmark1',
        'nearest_landmark2',
        'nearest_landmark3',
        'amenities',
        'status',
        'user_id',
    ];

    protected $casts = [
        '_id' => 'string',
        'user_id' => 'string',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class, 'destination_id');
    }

    public function reports() {
        return $this->hasMany(Report::class);
    }

}