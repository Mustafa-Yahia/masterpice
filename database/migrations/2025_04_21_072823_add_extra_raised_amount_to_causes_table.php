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
    Schema::table('causes', function (Blueprint $table) {
        $table->decimal('extra_raised_amount', 10, 2)->default(0); // العمود لحفظ المبلغ الزائد
    });
}

public function down()
{
    Schema::table('causes', function (Blueprint $table) {
        $table->dropColumn('extra_raised_amount');
    });
}

};
