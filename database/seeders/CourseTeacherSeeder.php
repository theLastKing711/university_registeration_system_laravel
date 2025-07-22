<?php

namespace Database\Seeders;

use App\Models\ClassroomCourseTeacher;
use App\Models\Course;
use App\Models\CourseAttendance;
use App\Models\CourseTeacher;
use App\Models\Department;
use App\Models\Exam;
use App\Models\Lecture;
use App\Models\OpenCourseRegisteration;
use App\Models\Teacher;
use App\Models\User;
use Context;
use Illuminate\Database\Seeder;

class CourseTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $open_courses =
            OpenCourseRegisteration::all();

        $it_department_id =
            Department::query()
                ->firstWhere(
                    'name',
                    'IT'
                )
                ->id;

        $open_courses->each(function (OpenCourseRegisteration $course) use ($it_department_id) {

            $random_two_teachers_ids =
                Teacher::query()
                    ->where(
                        'department_id',
                        $it_department_id,
                    )
                    ->inRandomOrder()
                    ->take(2)
                    ->pluck('id');

            $teachers_attach_data =
                collect(value: [$random_two_teachers_ids[0], $random_two_teachers_ids[1]])
                    ->mapWithKeys(function ($teacher_id, $index) use (&$z) {

                        if ($index % 2 === 0) {

                            return [
                                $teacher_id => [
                                    'is_main_teacher' => true,
                                ],
                            ];
                        }

                        return [
                            $teacher_id => [
                                'is_main_teacher' => false,
                            ],
                        ];
                    })
                    ->all();

            $course
                ->teachers()
                ->attach($teachers_attach_data);

        });

        Context::add(
            'course_teacher',
            CourseTeacher::all()
        );

        // CourseTeacher::query()
        //     ->with(
        //         [
        //             'course' => [
        //                 'students',
        //                 'academicYearSemester',
        //             ],
        //         ]
        //     )
        //     ->get()
        //     ->each(function (CourseTeacher $course_teacher, $index) {

        //         $course =
        //             $course_teacher
        //                 ->course;

        //         $course_year =
        //             $course
        //                 ->academicYearSemester
        //                 ->year;

        //         $course_semester =
        //             $course
        //                 ->academicYearSemester
        //                 ->semester;

        //         if ($course_teacher->is_main_teacher) {

        //             Exam::factory()
        //                 ->semesterMainExamsMaxMarkSequence()
        //                 ->withRandomFromTo()
        //                 ->withRandomExamDate($course_year, $course_semester)
        //                 ->withCourseTeacherId($course_teacher->id)
        //                 ->create();
        //         } else {
        //             Exam::factory()
        //                 ->semesterPracticalExamsSequence()
        //                 ->withRandomFromTo()
        //                 ->withRandomExamDate($course_year, $course_semester)
        //                 ->withCourseTeacherId($course_teacher->id)
        //                 ->create();
        //         }

        //         ClassroomCourseTeacher::factory()
        //             ->withCourseTeacherId($course_teacher->id)
        //             ->withRandomFromTo()
        //             ->count(2)
        //             ->create();

        //         $lectures = Lecture::factory()
        //             ->withCourseTeacherId($course_teacher->id)
        //             ->with15LecturesForEachSequence($course_year, $course_semester)
        //             ->create();

        //         // ->hasAttached(
        //         //     $it_courses,
        //         //     fn (): mixed => ['final_mark' => fake()->numberBetween(30, 100)], // runs once per it_course
        //         //     'courses' // the many to many relation for User Model we insert for $it_course
        //         // )

        //         $course_teacher
        //             ->course
        //             ->students
        //             ->each(callback: function (User $student) use ($lectures) {

        //                 CourseAttendance::factory()
        //                     ->withStudentId($student->id)
        //                     ->withLectureIdsForEachSequence($lectures)
        //                     ->create();

        //             });

        //         // }

        //     });

    }
}
