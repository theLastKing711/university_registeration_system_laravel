<?php

namespace Database\Seeders;

use App\Models\CourseTeacher;
use App\Models\Exam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseTeacher::query()
            ->with(
                [
                    'course' => [
                        'students',
                        'academicYearSemester',
                    ],
                ]
            )
            ->get()
            ->each(function (CourseTeacher $course_teacher, $index) {

                $course =
                    $course_teacher
                        ->course;

                $course_year =
                    $course
                        ->academicYearSemester
                        ->year;

                $course_semester =
                    $course
                        ->academicYearSemester
                        ->semester;

                if ($course_teacher->is_main_teacher) {

                    Exam::factory()
                        ->semesterMainExamsMaxMarkSequence()
                        ->withRandomFromTo()
                        ->withRandomExamDate($course_year, $course_semester)
                        ->withCourseTeacherId($course_teacher->id)
                        ->create();

                } else {

                    Exam::factory()
                        ->semesterPracticalExamsSequence()
                        ->withRandomFromTo()
                        ->withRandomExamDate($course_year, $course_semester)
                        ->withCourseTeacherId($course_teacher->id)
                        ->create();

                }

            });
    }
}
