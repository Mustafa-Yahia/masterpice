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
        'payment_method',
        'paypal_email',
        'credit_card_name',
        'credit_card_number',
        'credit_card_expiry',
        'credit_card_cvc',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

  public function paymentMethod()
  {
      return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
  }
}
