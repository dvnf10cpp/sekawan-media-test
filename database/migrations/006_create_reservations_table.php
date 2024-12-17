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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id')->primary();
            $table->unsignedBigInteger('vehicle_id');
            $table->uuid('admin_id');
            $table->unsignedBigInteger('mine_id');
            $table->uuid('driver_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles');
            $table->foreign('admin_id')->references('user_id')->on('users');
            $table->foreign('mine_id')->references('mine_id')->on('mines');
            $table->foreign('driver_id')->references('driver_id')->on('drivers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
