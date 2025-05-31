<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function belongsToItDepartment(): static
    {
        return $this->afterCreating(function (Course $course) {

            $course
                ->departments()
                ->attach([1]);

        });
    }

    public function belongsToEnglishDepartment(): static
    {
        return $this->afterCreating(function (Course $course) {

            $course
                ->departments()
                ->attach([2]);

        });
    }
}
