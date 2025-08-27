<?php

namespace Database\Seeders;

use App\Models\AcademicYearSemester;
use App\Models\Department;
use App\Models\OpenCourseRegisteration;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Context;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class StudentCourseRegisterationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  Collection<Department>  $departments
     * @param  Collection<AcademicYearSemester>  $academic_year_semesters
     * @param  Collection<OpenCourseRegisteration>  $open_course_registerations
     * @param  Collection<User>  $students
     */
    public function run(
        #[Context('departments')] Collection $departments,
        #[Context('academic_year_semesters')] Collection $academic_year_semesters,
        #[Context(OpenCourseRegisteration::class)] Collection $open_course_registerations,
        #[Context('students')] Collection $students

    ): void {

        $students->each(function (User $student) {

            $student_department_id =
                $student->department_id;

            // $university_first_open_year =
            //     2014;

            $student_enrollment_year =
                Carbon::parse(
                    $student
                        ->enrollment_date
                )
                    ->year;

            $registerable_courses_years =
                collect()
                    ->range(
                        1,
                        fake()
                            ->numberBetween(1, 3)
                    );

            $registerable_courses_years
                ->map(function (int $current_student_year) use ($student, $student_department_id, $student_enrollment_year) {

                    $courses_year =
                        $student_enrollment_year
                        +
                        $current_student_year
                        -
                        1;

                    $courses_ids =
                        OpenCourseRegisteration::query()
                            ->whereRelation(
                                'academicYearSemester',
                                'year',
                                $courses_year
                            )
                            ->whereRelation(
                                'course',
                                'open_for_students_in_year',
                                $current_student_year
                            )
                            ->whereRelation(
                                'course',
                                'department_id',
                                $student_department_id
                            )
                            ->pluck('id');

                    $student
                        ->courses()
                        ->attach($courses_ids, ['final_mark' => 30]);

                });

        });

    }
}
