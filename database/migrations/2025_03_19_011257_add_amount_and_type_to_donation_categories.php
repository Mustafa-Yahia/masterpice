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
        Schema::table('donation_categories', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->nullable()->after('description'); // مبلغ التبرع (للأنواع الثابتة فقط)
            $table->enum('type', ['fixed', 'custom', 'multiple_choices'])->default('fixed')->after('amount');
        });
    }

    public function down()
    {
        Schema::table('donation_categories', function (Blueprint $table) {
            $table->dropColumn(['amount', 'type']);
        });
    }
};
