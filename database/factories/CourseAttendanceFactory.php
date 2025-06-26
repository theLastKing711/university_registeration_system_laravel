<?php

namespace Database\Factories;

use App\Models\Lecture;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseAttendance>
 */
class CourseAttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_student_present' => $this->faker->boolean(60),
        ];
    }

    // public function withCourseTeacherId(int $course_teacher_id): static
    // {
    //     return
    //         $this->
    //             state(
    //                 [
    //                     'course_teacher_id' => $course_teacher_id,
    //                 ]
    //             );
    // }

    public function withStudentId(int $student_id): static
    {
        return
            $this->
                state(
                    [
                        'student_id' => $student_id,
                    ]
                );
    }

    // public function with15DaysForEachSequence(string $year, int $semester): static
    // {

    //     $semesters = [
    //         0 => 1,
    //         1 => 3,
    //         2 => 4,
    //     ];

    //     $first_day_date =
    //         Carbon::createFromDate(
    //             (int) $year,
    //             $semesters[$semester],
    //             1
    //         );

    //     $date_sequence =
    //         collect(
    //             range(1, 15)
    //         )
    //             ->map(function ($day, $index) use ($first_day_date) {

    //                 if ($index % 2 === 0) {
    //                     return [
    //                         'date' => $first_day_date->toImmutable()->addDays(floor($index / 2) * 7)->toDateString(),
    //                     ];
    //                 }

    //                 return [
    //                     'date' => $first_day_date->toImmutable()->addDays(floor($index / 2) * 7 + 1)->toDateString(),
    //                 ];

    //             });

    //     return
    //         $this->
    //             forEachSequence(
    //                 ...$date_sequence
    //             );
    // }

    /**
     * @param  Collection<Lecture>  $lectures
     */
    public function withLectureIdsForEachSequence($lectures): static
    {

        $date_sequence =
            $lectures
                ->map(function (Lecture $lecture, $index) {
                    return ['lecture_id' => $lecture->id];
                });

        return
            $this->
                forEachSequence(
                    ...$date_sequence
                );
    }
}
