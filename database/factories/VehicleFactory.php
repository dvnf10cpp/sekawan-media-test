<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = collect(['Passenger', 'Cargo']);
        $owners = collect(['Company', 'Rental']);

        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\FakeCar($faker));

        $regionCodes = ['B', 'D', 'AB', 'Z', 'F', 'N', 'L', 'H'];
        $number = $faker->numberBetween(1000, 9999);
        $letters = strtoupper($faker->lexify('???')); 

        return [
            'vehicle_name' => $faker->vehicle,
            'vehicle_type' => $types->random(),
            'vehicle_owner' => $owners->random(),
            'number_plate' => $faker->randomElement($regionCodes) . ' ' . $number . ' ' . $letters,
        ];
    }
}
