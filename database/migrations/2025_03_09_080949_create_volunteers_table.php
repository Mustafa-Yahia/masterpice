<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('volunteers', function (Blueprint $table) {
        $table->id();
        $table->string('full_name');
        $table->date('birth_date');
        $table->string('phone');
        $table->string('nationality');
        $table->string('gender');
        $table->string('country');
        $table->string('city');
        $table->string('occupation');
        $table->string('email')->unique();
        $table->boolean('previous_volunteer')->default(false);
        $table->string('how_heard')->nullable();
        $table->text('volunteer_experience')->nullable();
        $table->string('national_id', 10)->unique()->nullable();

        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('volunteers');
    }
};
