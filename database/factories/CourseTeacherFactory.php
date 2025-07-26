<?php

namespace Database\Factories;

use App\Models\OpenCourseRegisteration;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseTeacher>
 */
class CourseTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'course_id' => OpenCourseRegisteration::inRandomOrder()->first()->id,
            'is_main_teacher' => $this->faker->boolean(),
        ];
    }

    public function withTeacherId(int $teacher_id): static
    {

        return $this->state(fn (array $attributes) => [
            'teacher_id' => $teacher_id,
        ]);

    }

    public function withdepartmentId(int $department_id): static
    {

        return $this->state(fn (array $attributes) => [
            'department_id' => $department_id,
        ]);

    }

    public function withCourseId(int $course_id): static
    {

        return $this->state(fn (array $attributes) => [
            'course_id' => $course_id,
        ]);

    }

    public function mainTeacher(): static
    {

        return $this->state(fn (array $attributes) => [
            'is_main_teacher' => true,
        ]);

    }

    public function notMainTeacher(): static
    {

        return $this->state(fn (array $attributes) => [
            'is_main_teacher' => false,
        ]);

    }
}
