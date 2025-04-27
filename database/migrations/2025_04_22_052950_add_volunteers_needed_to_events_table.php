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
        $table->integer('volunteers_needed')->default(0);  // عدد المتطوعين المطلوبين
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn('volunteers_needed');
    });
}

};
