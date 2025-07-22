<?php

namespace Database\Seeders;

use App\Models\ClassroomCourseTeacher;
use App\Models\CourseTeacher;
use Illuminate\Database\Seeder;

class ClassroomCourseTeacherSeeder extends Seeder
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

                ClassroomCourseTeacher::factory()
                    ->withCourseTeacherId($course_teacher->id)
                    ->withRandomFromTo()
                    ->count(2)
                    ->create();

            });
    }
}
