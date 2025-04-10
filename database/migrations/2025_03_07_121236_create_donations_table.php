<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2);  // المبلغ
            $table->string('currency');  // العملة
            $table->string('payment_method');  // طريقة الدفع
            $table->string('paypal_email')->nullable();  // البريد الإلكتروني لـ PayPal
            $table->string('credit_card_name')->nullable();  // اسم حامل البطاقة
            $table->string('credit_card_number')->nullable();  // رقم البطاقة
            $table->string('credit_card_expiry')->nullable();  // تاريخ انتهاء البطاقة
            $table->string('credit_card_cvc')->nullable();  // رمز الأمان
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ربط التبرع بالمستخدم
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
