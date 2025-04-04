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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('donation_categories')->onDelete('cascade'); // ربط التبرعات بالفئة
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('set null'); // ربط طريقة الدفع
            $table->decimal('amount', 10, 2);  // مبلغ التبرع
            $table->enum('currency', ['USD', 'JOD'])->default('JOD');  // العملة
            $table->string('payment_status')->default('pending');  // حالة الدفع
            $table->timestamps();
            $table->softDeletes();  // دعم الحذف المنطقي
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
