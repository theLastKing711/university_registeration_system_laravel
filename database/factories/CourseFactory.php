<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Department;
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

        $it_department_id =
            Department::query()
                ->firstWhere('name', 'IT')
                ->id;

        return $this->afterCreating(function (Course $course) use ($it_department_id) {

            $course
                ->departments()
                ->attach([$it_department_id]);

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
