<?php

namespace Database\Seeders;

use App\Models\ClassroomCourseTeacher;
use App\Models\CourseTeacher;
use Illuminate\Container\Attributes\Context;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ClassroomCourseTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  Collection<CourseTeacher>  $course_teachers
     */
    public function run(#[Context('course_teacher')] Collection $course_teachers): void
    {

        $course_teachers->each(function (CourseTeacher $course_teacher, $index) {

            ClassroomCourseTeacher::factory()
                ->withCourseTeacherId($course_teacher->id)
                ->withRandomFromTo()
                ->count(2)
                ->create();

        });
    }
}
