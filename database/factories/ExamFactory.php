<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\CourseTeacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    public $classrooms = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $this->classrooms =
            Classroom::all();

        return [
            'course_teacher_id' => fake()->randomElement(CourseTeacher::all())->first()->id,
            'classroom_id' => fake()->randomElement($this->classrooms)->id,
            'max_mark' => fake()->numberBetween(30, 70),
            'date' => fake()->date(),
            'is_main_exam' => fake()->boolean(),

        ];
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

    // public function withRandomClassroom(): static
    // {

    //     $classrooms =
    //             Classroom::query()
    //                 ->all();

    // }

    public function semesterPracticalExamsSequence(): static
    {

        return
            $this->
                forEachSequence(
                    [
                        'max_mark' => 10,
                    ],
                    [
                        'max_mark' => 10,
                    ],
                );
    }

    public function semesterMainExamsMaxMarkSequence(): static
    {
        return
            $this->forEachSequence(
                [
                    'max_mark' => 10,
                ],
                [
                    'max_mark' => 10,
                ],
                [
                    'is_main_exam' => true,
                    'max_mark' => 60,
                ],
            );
    }

    public function withCourseTeacherId(int $teacher_id): static
    {
        return $this->state([
            'course_teacher_id' => $teacher_id,
        ]);
    }

    public function withRandomExamDate(string $year, int $semester): static
    {
        $semesters = [
            0 => 2,
            1 => 4,
            2 => 5,
        ];

        $exam_year = $year;

        $exam_month = '0'.strval($semesters[$semester]);

        $exam_day =
            strval(
                fake()->numberBetween(1, int2: 28)
            );

        if (strlen($exam_day) === 1) {
            $exam_day = "0{$exam_day}";
        }

        return $this->state([
            'date' => "{$exam_year}-{$exam_month}-{$exam_day}",
        ]);
    }
}
