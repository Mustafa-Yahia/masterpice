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
        Schema::table('event_user', function (Blueprint $table) {
            $table->dropColumn('status'); // حذف العمود
        });
    }

    public function down()
    {
        Schema::table('event_user', function (Blueprint $table) {
            $table->string('status'); // إعادة العمود إذا احتجنا للرجوع
        });
    }


};
