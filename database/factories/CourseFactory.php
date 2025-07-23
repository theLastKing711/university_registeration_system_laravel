<?php

namespace Database\Factories;

use App\Models\AcademicYearSemester;
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
            'department_id' => $this->faker->randomElement(Department::all())->id,
            'name' => $this->faker->name,
            'code' => $this->faker->text(5),
            'is_active' => $this->faker->boolean(),
            'credits' => 3,
            'open_for_students_in_year' => 0,
            'academic_year_semester_id' => AcademicYearSemester::inRandomOrder()->first(),
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
