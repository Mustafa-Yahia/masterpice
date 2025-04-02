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
        Schema::create('volunteer_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name'); // اسم الحقل (مثل: الاسم الكامل)
            $table->string('field_type'); // نوع الحقل (نص، تاريخ، قائمة، الخ)
            $table->text('field_options')->nullable(); // خيارات الحقل (إذا كان حقل اختيار متعدد أو قائمة)
            $table->boolean('is_active')->default(true); // حالة الحقل: هل هو مفعل أم لا
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_fields');
    }
};
