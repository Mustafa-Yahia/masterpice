<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_add_additional_details_to_causes_table.php

public function up()
{
    Schema::table('causes', function (Blueprint $table) {
        $table->text('additional_details')->nullable(); // إضافة الحقل الجديد
    });
}

public function down()
{
    Schema::table('causes', function (Blueprint $table) {
        $table->dropColumn('additional_details');
    });
}

};
