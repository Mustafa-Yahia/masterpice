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
        $table->string('location_url')->nullable(); // الرابط الخارجي للموقع
        $table->text('mission')->nullable(); // مهمة الحدث
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn('location_url');
        $table->dropColumn('mission');
    });
}

};
