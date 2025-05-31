<?php

namespace Database\Factories;

use App\Enum\Auth\RolesEnum;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'national_id' => $this->faker->randomNumber(6),
            'birthdate' => $this->faker->date(),
            'graduation_date' => null,
            'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function staticAdmin(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::ADMIN);
        });
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ])->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::ADMIN);
        });
    }

    public function fromItDepartment(): static
    {

        return $this->state(fn (array $attributes) => [
            'department_id' => 1,
        ]
        );
    }

    public function fromEnglishDepartment(): static
    {

        return $this->state(fn (array $attributes) => [
            'department_id' => 2,
        ]
        );
    }

    public function enrolledInYear(int $year): static
    {

        return $this->state(fn (array $attributes) => [
            'enrollment_date' => Carbon::createFromFormat('Y', $year)->toDateTimeString(),
        ]
        );
    }

    public function graduatedInYear(int $year): static
    {
        return $this->state(fn (array $attributes) => [
            'graduation_date' => Carbon::createFromFormat('Y', $year)->toDateTimeString(),
        ]
        );
    }

    public function unGraduated(): static
    {
        return $this->state(fn (array $attributes) => [
            'graduation_date' => null,
        ]
        );
    }
}
