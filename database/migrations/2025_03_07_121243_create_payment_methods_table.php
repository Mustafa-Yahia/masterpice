<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();  // هذا يقوم بإنشاء العمود id من النوع unsignedBigInteger
            $table->string('method_name');  // اسم طريقة الدفع (مثل: PayPal، Credit Card)
            $table->text('description')->nullable();  // وصف طريقة الدفع (اختياري)
            $table->timestamps();  // أوقات الإنشاء والتعديل
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
