<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->unsignedBigInteger('cause_id')->after('id');
            $table->unsignedBigInteger('payment_method_id')->after('cause_id');

            $table->foreign('cause_id')->references('id')->on('causes')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['cause_id']);
            $table->dropForeign(['payment_method_id']);
            $table->dropColumn(['cause_id', 'payment_method_id']);
        });
    }
};
