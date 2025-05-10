<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimelineEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'title',
        'description'
    ];

    protected $casts = [
        'year' => 'integer', // تأكيد أن السنة تخزن كرقم صحيح
    ];
}
