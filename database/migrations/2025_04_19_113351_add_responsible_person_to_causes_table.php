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
            $table->string('responsible_person_name')->nullable(); // Name of the responsible person
            $table->string('responsible_person_email')->nullable(); // Email of the responsible person
        });
    }

    public function down()
    {
        Schema::table('causes', function (Blueprint $table) {
            $table->dropColumn('responsible_person_name');
            $table->dropColumn('responsible_person_email');
        });
    }

};
