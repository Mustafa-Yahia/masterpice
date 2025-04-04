<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount', 'currency', 'payment_status', 'user_id', 'category_id'
    ];

    // يمكنك إضافة العلاقات (Relations) هنا إذا كنت تستخدم علاقة مع جدول المستخدمين أو الفئات.

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function paymentMethod()
{
    return $this->belongsTo(PaymentMethod::class);
}

 public function category()
 {
     return $this->belongsTo(DonationCategory::class);
 }
}
