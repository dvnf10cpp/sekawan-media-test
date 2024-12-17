<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Mine;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::whereHas('role', function($q) {
            $q->where('role_name', '=', 'Admin');
        })->get();

        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $mines = Mine::all();

        $start = fake()->date('Y-m-d', 'now');
        $end = fake()->dateTimeBetween($start, '+1 year')->format('Y-m-d');

        $created = Carbon::now()->subMonths(rand(1,6));

        return [
            'vehicle_id' => $vehicles->random()->vehicle_id,
            'admin_id' => $users->random()->user_id,
            'driver_id' => $drivers->random()->driver_id,
            'mine_id' =>$mines->random()->mine_id,
            'start_date' => $start,
            'end_date' => $end,
            'created_at' => $created,
            'updated_at' => $created,
        ];
    }
}
