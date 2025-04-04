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
    Schema::create('donation_categories', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // عنوان الفئة
        $table->text('description')->nullable(); // وصف الفئة
        $table->string('image')->nullable(); // صورة الفئة
        $table->string('slug')->unique(); // لتوليد رابط فريد
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_categories');
    }
};
