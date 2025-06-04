<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\OpenCourseRegisteration;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\openCourseRegisteration>
 */
class OpenCourseRegisterationFactory extends Factory
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
            'semester' => $this->faker->numberBetween(0, 2),
        ];
    }

    public function openFrom2014To2015(): static
    {

        $random_semester = $this->faker->numberBetween(0, 2);

        return
            $this->forEachSequence(
                [
                    'year' => 2014,
                ],
                [
                    'year' => 2015,
                ],

            );
    }

    public function hasTwoTeachers(): static
    {

        return
            $this->afterCreating(function (OpenCourseRegisteration $course) {

                $teachers =
                    Teacher::query()
                        ->where(
                            'department_id',
                            1,
                        )
                        ->inRandomOrder()
                        ->take(2)
                        ->pluck('id');

                $course->teachers()->attach($teachers);

            });
    }

    // public function hasSixExams(): static
    // {

    //     return
    //         $this->afterCreating(function (OpenCourseRegisteration $course) {

    //             $semester_exams =
    //                 Exam::query()
    //                     ->factory()
    //                     ->semesterExamsSequence()
    //                     ->state([

    //                     ])

    //         });
    //     // return
    //     //     $this->
    //     //         has(
    //     //             Exam::factory()
    //     //                 ->semesterExamsSequence()
    //     //         );

    // }

    public function openFrom2014To2019(): static
    {

        $random_semester = $this->faker->numberBetween(0, 2);

        return
            $this->forEachSequence(
                [
                    'year' => 2014,
                    // 'semester' => $random_semester,
                ],
                [
                    'year' => 2015,
                    // 'semester' => $random_semester,
                ],
                // [
                //     'year' => 2016,
                //     // 'semester' => $random_semester,
                // ],
                // [
                //     'year' => 2017,
                //     // 'semester' => $random_semester,
                // ],
                // [
                //     'year' => 2018,
                //     // 'semester' => $random_semester,
                // ],
                // [
                //     'year' => 2019,
                //     // 'semester' => $random_semester,
                // ],
            );
    }

    public function withThreeSemesters(): static
    {

        $random_semester = $this->faker->numberBetween(0, 2);

        return
            $this->forEachSequence(
                [
                    'semester' => 0,
                ],
                [
                    'semester' => 1,
                ],
                [
                    'semester' => 2,
                ],
                [
                    'semester' => 0,
                ],
                [
                    'semester' => 1,
                ],
                [
                    'semester' => 2,
                ],
            );
    }
}
