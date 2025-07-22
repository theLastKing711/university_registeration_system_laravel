<?php

namespace Database\Seeders;

use App\Models\CourseAttendance;
use App\Models\CourseTeacher;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Container\Attributes\Context;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CourseAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  Collection<CourseTeacher>  $course_teachers
     * @param  Collection<Lecture>  $lectures
     */
    public function run(
        #[Context('course_teacher')] Collection $course_teachers,
        #[Context('lectures')] Collection $context_lectures
    ): void {
        $course_teachers
            ->load(
                [
                    'course' => [
                        'students',
                    ],
                ]
            )
            ->each(function (CourseTeacher $course_teacher) use ($context_lectures) {

                $lectures =
                    $context_lectures
                        ->where(
                            'course_teacher_id',
                            $course_teacher->id
                        );

                $course_teacher
                    ->course
                    ->students
                    ->each(callback: function (User $student) use ($lectures) {

                        CourseAttendance::factory()
                            ->withStudentId($student->id)
                            ->withLectureIdsForEachSequence($lectures)
                            ->create();

                    });

            });
    }
}
