<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // معرف الحدث (سيفعل تلقائيًا العمود id كـ primary key)
            $table->string('title'); // عنوان الحدث
            $table->text('description'); // وصف الحدث
            $table->date('date'); // تاريخ الحدث
            $table->time('time'); // وقت الحدث
            $table->string('location'); // موقع الحدث
            $table->string('image')->nullable(); // صورة الحدث (يمكن أن تكون فارغة)
            $table->timestamps(); // تاريخ ووقت الإنشاء والتحديث
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events'); // حذف الجدول إذا تم التراجع عن الـ Migration
    }
}
