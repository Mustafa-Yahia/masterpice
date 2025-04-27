<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; // إضافة هذا السطر

class User extends Authenticatable
{
    use HasFactory, SoftDeletes; // إضافة SoftDeletes هنا

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];  // تحديد الحقول التي يجب أن تكون تواريخ


    public function donations()
    {
        return $this->hasMany(Donation::class);
    }


    public function subscriptions()
{
    return $this->hasMany(Subscription::class);
}

public function events()
{
    return $this->belongsToMany(Event::class, 'event_volunteer', 'user_id', 'event_id');
}


public function volunteers()
{
    return $this->belongsToMany(User::class, 'event_volunteer', 'event_id', 'user_id');
}

}
