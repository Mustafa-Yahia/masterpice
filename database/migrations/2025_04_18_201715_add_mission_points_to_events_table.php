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
            $table->string('mission_point_1')->nullable();  // إضافة العمود mission_point_1
            $table->string('mission_point_2')->nullable();  // إضافة العمود mission_point_2
            $table->string('mission_point_3')->nullable();  // إضافة العمود mission_point_3
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['mission_point_1', 'mission_point_2', 'mission_point_3']);
        });
    }

};
