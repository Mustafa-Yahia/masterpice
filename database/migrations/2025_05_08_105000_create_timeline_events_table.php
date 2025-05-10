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
    Schema::create('timeline_events', function (Blueprint $table) {
        $table->id();
        $table->year('year'); // تغيير من string إلى نوع year
        $table->string('title', 255); // تحديد طول الحقل
        $table->text('description');
        $table->timestamps();
        $table->softDeletes(); // لحذف البيانات بشكل مؤقت
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeline_events');
    }
};
