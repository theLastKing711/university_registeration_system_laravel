<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassroomCourseTeacher>
 */
class ClassroomCourseTeacherFactory extends Factory
{
    protected $table = 'classroom_course_teacher';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $classrooms =
            Classroom::all();

        return [
            'classroom_id' => $this->faker->randomElement($classrooms)->id,
            'day' => $this->faker->numberBetween(2, 6),
        ];
    }

    public function withCourseTeacherId(int $course_teacher_id): static
    {

        return $this->state(
            [
                'course_teacher_id' => $course_teacher_id,
            ]
        );

    }

    public function withRandomFromTo()
    {

        return $this->state(function (array $attributes) {

            $exam_times = [
                8,
                10,
                12,
                14,
                16,
            ];

            $exam_from = fake()->randomElement($exam_times);

            $exam_to = strval($exam_from + 2);

            $exam_from = strval($exam_from);

            $exam_from =
                strlen($exam_from) === 1 ? "0{$exam_from}:00:00"
                :
                "{$exam_from}:00:00";

            $exam_to =
                strlen($exam_to) === 1
                ?
                "0{$exam_to}:00:00"
                :
                "{$exam_to}:00:00";

            return
                [
                    'from' => $exam_from,
                    'to' => $exam_to,
                ];
        });
    }
}
