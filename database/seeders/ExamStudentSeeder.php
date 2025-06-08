<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExamStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exam::query()
            ->with(
                [
                    'courseTeacher' => [
                        'course' => [
                            'students',
                        ],
                    ],
                ]
            )
            ->each(function (Exam $exam) {

                $exam_students_ids_with_pivot = [];

                $exam
                    ->courseTeacher
                    ->course
                    ->students
                    ->each(callback: function (User $student) use (&$exam_students_ids_with_pivot, $exam) {

                        $exam_course_teacher =
                             $exam
                                 ->courseTeacher;

                        $ranom_mark =
                            $exam_course_teacher
                                ->is_main_teacher
                                &&
                                $exam
                                    ->is_main_exam
                                ?
                                fake()->numberBetween(40, 100)
                                :
                                fake()->numberBetween(5, 10);

                        $exam_students_ids_with_pivot[$student->id] =
                            [
                                'mark' => $ranom_mark,
                            ];

                    });

                $exam
                    ->students()
                    ->attach($exam_students_ids_with_pivot);

            });
    }
}
