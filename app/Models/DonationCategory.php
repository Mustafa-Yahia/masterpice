<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DonationOption;

class DonationCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'slug', 'amount', 'type'];

     // علاقة مع التبرعات
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

}




