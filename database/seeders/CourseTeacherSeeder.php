<?php

namespace Database\Seeders;

use App\Models\ClassroomCourseTeacher;
use App\Models\CourseAttendance;
use App\Models\CourseTeacher;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseTeacher::query()
            ->with('course.students')
            ->get()
            ->each(function (CourseTeacher $course_teacher, $index) {

                $course =
                    $course_teacher
                        ->course;

                $course_year =
                    $course
                        ->year;

                $course_semester =
                    $course
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
                ClassroomCourseTeacher::factory()
                    ->withCourseTeacherId($course_teacher->id)
                    ->withRandomFromTo()
                    ->count(2)
                    ->create();

                $course_teacher_students =
                    $course_teacher
                        ->course
                        ->students
                        ->each(callback: function (User $student) use ($course_teacher, $course_year, $course_semester) {

                            CourseAttendance::factory()
                                ->withCourseTeacherId($course_teacher->id)
                                ->withStudentId($student->id)
                                ->with15DaysForEachSequence($course_year, $course_semester)
                                ->create();

                        });

                // }

            });

    }
}
