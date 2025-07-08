<?php

namespace Database\Factories;

use App\Enum\Auth\RolesEnum;
use App\Models\Department;
use App\Models\User;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $random_department =
            Department::first();

        return [
            'depratment_id' => $random_department->id,
            'national_id' => fake()->randomNumber(6, true),
            'enrollment_date' => fake()->date(),
            'graduation_date' => fake()->date(),
            'phone_number' => fake()->phoneNumber(),

        ];
    }

    public function staticStudent(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'student',
            'password' => Hash::make('student'),
            'enrollment_date' => '2014-01-01',
        ])->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::STUDENT);
        });

    }
}
