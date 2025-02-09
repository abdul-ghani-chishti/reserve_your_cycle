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
        Schema::create('cycle_availabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cycle_id')->index();
            $table->integer('owner_id')->index(); //user_id
            $table->integer('user_id')->nullable()->default(NULL)->index(); //user_id -> who booked the cycle
            $table->integer('cycle_availability_status_id');
            $table->timestamp('available_date');
            $table->timestamp('available_hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycle_availabilities');
    }
};
