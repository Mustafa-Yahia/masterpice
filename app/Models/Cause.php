<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'raised_amount',
        'goal_amount',
        'end_time',
        'additional_details',
        'category',
        'user_id',
        'location',
        'responsible_person_name',  // Added field
        'responsible_person_email', // Added field
        'extra_raised_amount', // Added field for excess amount
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
