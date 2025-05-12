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
            $table->integer('cycle_status_id')->default(1)->index(); // 1 Available,2 Reserved, 3 Unavailable,
            $table->string('brand');
            $table->string('description');
            $table->string('type');
            $table->string('model');
            $table->string('cycle_sku');
//            $table->timestamps('available_date');
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
