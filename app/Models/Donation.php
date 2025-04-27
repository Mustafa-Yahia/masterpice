<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'currency',
        'card_holder_name',
        'card_number',
        'card_expiry',
        'card_cvc',
        'user_id',
        'cause_id',
        'payment_method_id'
    ];

    protected $dates = ['deleted_at'];

    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
