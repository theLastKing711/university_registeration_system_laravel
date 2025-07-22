<?php

namespace Database\Seeders;

use App\Models\CourseTeacher;
use App\Models\Lecture;
use Context as GlobalContext;
use Illuminate\Container\Attributes\Context;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class LectureSeeder extends Seeder
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

                Lecture::factory()
                    ->withCourseTeacherId($course_teacher->id)
                    ->with15LecturesForEachSequence($course_year, $course_semester)
                    ->create();

            });

        GlobalContext::add(
            'lectures',
            Lecture::all()
        );

    }
}
