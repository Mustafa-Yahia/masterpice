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
    Schema::table('events', function (Blueprint $table) {
        $table->decimal('latitude', 10, 6)->nullable();  // إضافة العمود latitude
        $table->decimal('longitude', 10, 6)->nullable(); // إضافة العمود longitude
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn(['latitude', 'longitude']);
    });
}

};
