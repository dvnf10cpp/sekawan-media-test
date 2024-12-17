<?php

namespace Database\Factories;

use App\Models\VehicleService;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleServiceFactory extends Factory
{
    protected $model = VehicleService::class;

    public function definition(): array
    {
        $vehicles = Vehicle::all();

        return [
            'vehicle_id' => $vehicles->random()->vehicle_id,
            'service_date' => $this->faker->date(),
            'service_description' => $this->faker->sentence(8),
        ];
    }
}
