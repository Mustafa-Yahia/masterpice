<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'date', 'time', 'location', 'image','location_url', 'mission',
    ];


    public function users()
{
    return $this->belongsToMany(User::class, 'event_user')
                ->withPivot('status'); // تضمين عمود "status"
}
public function volunteers()
{
    return $this->belongsToMany(User::class, 'event_volunteer', 'event_id', 'user_id');
}



}
