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
        Schema::create('vehicle_fuel_consumptions', function (Blueprint $table) {
            $table->id('fuel_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->enum('fuel_type', ['Diesel', 'Petrol', 'Gasoline']);
            $table->float('fuel_liters');
            $table->date('fuel_date');
            $table->timestamps();

            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_fuel_consumptions');
    }
};
