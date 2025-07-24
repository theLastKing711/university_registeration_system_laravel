<?php

namespace Database\Factories;

use App\Models\CourseTeacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecture>
 */
class LectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_teacher_id' => CourseTeacher::inRandomOrder()->first()?->id,
            'happened_at' => $this->faker->date(),
        ];
    }

    public function withCourseTeacherId(int $course_teacher_id): static
    {
        return
            $this->
                state(
                    [
                        'course_teacher_id' => $course_teacher_id,
                    ]
                );
    }

    public function happened_at(string $happened_at): static
    {
        return
            $this->
                state(
                    [
                        'happened_t' => $happened_at,
                    ]
                );
    }

    public function with15LecturesForEachSequence(string $year, int $semester): static
    {

        $semesters = [
            0 => 1,
            1 => 3,
            2 => 4,
        ];

        $first_day_date =
            Carbon::createFromDate(
                (int) $year,
                $semesters[$semester],
                1
            );

        $date_sequence =
            collect(
                range(1, 15)
            )
                ->map(function ($day, $index) use ($first_day_date) {

                    if ($index % 2 === 0) {
                        return [
                            'happened_at' => $first_day_date->toImmutable()->addDays(floor($index / 2) * 7)->toDateString(),
                        ];
                    }

                    return [
                        'happened_at' => $first_day_date->toImmutable()->addDays(floor($index / 2) * 7 + 1)->toDateString(),
                    ];

                });

        return
            $this->
                forEachSequence(
                    ...$date_sequence
                );
    }
}
