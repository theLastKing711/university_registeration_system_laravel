<?php

namespace Database\Factories;

use App\Models\AcademicYearSemester;
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
            // 'semester' => $this->faker->numberBetween(0, 2),
        ];
    }

    public function openFrom2014To2015(): static
    {

        $academic_semesters_years =
            AcademicYearSemester::all();

        $two_thouthand_fourthen_semester_ids =
            $academic_semesters_years
                ->where('year', 2014);

        $two_thouthand_fifteen_semester_ids =
            $academic_semesters_years
                ->where('year', 2015);

        return
            $this->forEachSequence(
                [
                    'academic_year_semester_id' => $this->faker->randomElement($two_thouthand_fourthen_semester_ids),
                ],
                [
                    'academic_year_semester_id' => $this->faker->randomElement($two_thouthand_fourthen_semester_ids),
                ],
            );
    }

    public function hasTwoTeachers(): static
    {

        return
            $this->afterCreating(function (OpenCourseRegisteration $course) {

                $teachers_ids =
                    Teacher::query()
                        ->where(
                            'department_id',
                            1,
                        )
                        ->inRandomOrder()
                        ->take(2)
                        ->pluck('id');

                $z = [];

                $teachers_attach_data =
                    collect(value: [$teachers_ids[0], $teachers_ids[1]])
                        ->map(function ($teacher_id, $index) use (&$z) {

                            if ($index % 2 === 0) {
                                $z[$teacher_id] = [
                                    'is_main_teacher' => true,
                                ];

                                return;
                            }

                            $z[$teacher_id] = [
                                'is_main_teacher' => false,
                            ];

                            return [
                                $teacher_id => [
                                    'is_main_teacher' => false,
                                ],
                            ];
                        })
                        ->collapseWithKeys()
                        ->all();

                $course
                    ->teachers()
                    ->attach($z);

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
