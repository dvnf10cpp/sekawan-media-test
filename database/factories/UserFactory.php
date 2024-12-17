<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => Uuid::uuid7(),
            'role_id' => '',
            'fullname' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'position' => fake()->randomElement([
                'Kepala',
                'Wakil',
                'Manager',
                'Supervisor',
                'Staff',
                'Assistant'
            ]),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
        ];
    }

    public function role(string $roleName)
    {
        $role = Role::where('role_name', '=', $roleName)->first();

        return $this->state(fn (array $attributes) => [
            'role_id' => $role->role_id,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
