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
        Schema::create('cycle_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->index(); // user_id
            $table->integer('cycle_status_id')->index();
            $table->string('brand');
            $table->string('description');
            $table->string('type');
            $table->string('model');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycle_infos');
    }
};
