<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('number');
            $table->string('zone_number');
            $table->string('building_number');
            $table->string('apartment_number');
            $table->string('car_model');
            $table->string('car_color');
            $table->string('car_number');
            $table->string('Car_Wash_Schedule_Days');
            $table->enum('status',['pending','paid','not-paid'])->nullable()->default('pending');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
