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
    ];

    // ✅ العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ العلاقة مع التبرعات
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
