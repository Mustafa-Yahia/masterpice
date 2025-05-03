<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cause extends Model
{
    use HasFactory;
    use SoftDeletes;

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
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // app/Models/Cause.php
public function scopeWithTrashed($query)
{
    return $query->where(function($query) {
        $query->whereNull('deleted_at')->orWhereNotNull('deleted_at');
    });
}
}
