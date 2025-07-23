<?php

namespace Database\Seeders;

use App\Models\CourseTeacher;
use App\Models\Exam;
use Illuminate\Container\Attributes\Context;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  Collection<CourseTeacher>  $course_teachers
     */
    public function run(#[Context('course_teacher')] Collection $course_teachers): void
    {
        $course_teachers
            ->load(
                [
                    'course' => [
                        'academicYearSemester',
                    ],
                ]
            )
            ->each(function (CourseTeacher $course_teacher, $index) {

                $this->createExamsFromCourseTeacher($course_teacher);

            });
    }

    public function createExamsFromCourseTeacher(CourseTeacher $course_teacher)
    {
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
    }
}
