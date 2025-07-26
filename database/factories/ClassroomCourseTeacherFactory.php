<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\CourseTeacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassroomCourseTeacher>
 */
class ClassroomCourseTeacherFactory extends Factory
{
    const EXAM_TIMES = [
        8,
        10,
        12,
        14,
        16,
    ];

    protected $table = 'classroom_course_teacher';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $from =
            fake()->randomElement(self::EXAM_TIMES);

        $to =
                Str::parseTimeStringFromInt($from + 2);

        $from =
                Str::parseTimeStringFromInt($from);

        $classrooms =
            Classroom::all();

        return [
            'course_teacher_id' => $this->faker->randomElement(CourseTeacher::all())->id,
            'classroom_id' => $this->faker->randomElement($classrooms)->id,
            'day' => $this->faker->numberBetween(2, 6),
            'from' => $from,
            'to' => $to,
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

            $exam_from =
                fake()->randomElement($exam_times);

            $exam_to =
                Str::parseTimeStringFromInt($exam_from + 2);

            $exam_from =
                Str::parseTimeStringFromInt($exam_from);

            return
                [
                    'from' => $exam_from,
                    'to' => $exam_to,
                ];
        });
    }

    public function withFromTo(int $from, int $to)
    {

        $exam_to =
            Str::parseTimeStringFromInt($from + 2);

        $exam_from =
            Str::parseTimeStringFromInt($to);

        return $this->state(function (array $attributes) use ($exam_from, $exam_to) {

            return
                [
                    'from' => $exam_from,
                    'to' => $exam_to,
                ];
        });
    }
}
