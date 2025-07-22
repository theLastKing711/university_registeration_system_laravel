<?php

namespace Database\Seeders;

use App\Models\CourseAttendance;
use App\Models\CourseTeacher;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseAttendanceSeeder extends Seeder
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
            ->each(function (CourseTeacher $course_teacher) {

                $lectures =
                    Lecture::query()
                        ->where(
                            'course_teacher_id',
                            $course_teacher->id
                        )
                        ->get();

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
