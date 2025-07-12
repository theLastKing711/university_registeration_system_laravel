<?php

namespace Tests\Feature\Student;

use App\Data\Student\OpenCourseRegisteration\RegisterCourses\Request\RegisterInOpenCoursesRequestData;
use App\Models\DepartmentRegisterationPeriod;
use App\Models\OpenCourseRegisteration;
use App\Models\StudentCourseRegisteration;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Student\Abstractions\StudentTestCase;

class StudentTest extends StudentTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths('open-course-registerations');

    }

    // get_open_courses_this_semester
    #[Test]
    public function get_open_courses_this_semester_with_200_response(): void
    {

        $response =
            $this
                ->getJsonData();

        $response
            ->assertStatus(200);
    }

    // get_student_course_schedule_this_semester
    #[Test]
    public function get_student_course_schedule_this_semester_with_200_response(): void
    {

        $response =
            $this
                ->withRoutePaths(
                    'schedule'
                )
                ->getJsonData();

        $response->assertStatus(200);
    }

    // get_student_open_course_marks
    #[Test]
    public function get_student_open_course_marks_with_200_response(): void
    {

        $response =
            $this
                ->withRoutePaths(
                    'marks'
                )
                ->getJsonData();

        $response
            ->assertStatus(200);
    }

    // get_student_marks_this_semester
    #[Test]
    public function get_student_student_course_marks_this_semester_with_200_response(): void
    {

        $response =
            $this
                ->withRoutePaths(
                    'marks',
                    'this-semester',
                )
                ->getJsonData();

        $response
            ->assertStatus(200);
    }

    // get_student_registered_open_courses_this_semester
    #[Test]
    public function get_student_registered_open_courses_this_semester_with_200_response(): void
    {

        $response =
            $this
                ->withRoutePaths(
                    'registered-courses',
                    'this-semester'
                )
                ->getJsonData();

        $response
            ->assertStatus(200);
    }

    // register_in_open_course
    #[Test]
    public function register_in_open_course_with_200_response(): void
    {

        $student =
            User::factory()
                ->staticStudent()
                ->fromItDepartment()
                ->create();

        $department_active_year_semester_id =
            DepartmentRegisterationPeriod::GetDepartmentActiveAcademicYearSemesterByDepartmentId(
                $this->student->department_id
            );

        $two_student_depratment_courses =
            OpenCourseRegisteration::query()
                ->where(
                    'academic_year_semester_id',
                    $department_active_year_semester_id
                )
                ->doesntHave('course.prerequisites')
                ->take(2)
                ->get();

        $this->actingAs($student);

        $register_in_open_course_request =
            new RegisterInOpenCoursesRequestData(
                $two_student_depratment_courses->pluck('id')
                    ->toArray()
            );

        $response =
            $this
                ->postJsonData(
                    $register_in_open_course_request
                        ->toArray()
                );

        $response->assertStatus(200);
    }

    #[Test]
    public function register_in_open_course_with_unfinished_required_prerequisites_fails_validation_with_422_response(): void
    {

        $department_active_year_semester_id =
           DepartmentRegisterationPeriod::GetDepartmentActiveAcademicYearSemesterByDepartmentId(
               $this->student->department_id
           );

        $student_department_courses =
            OpenCourseRegisteration::query()
                ->where(
                    'academic_year_semester_id',
                    $department_active_year_semester_id
                )
                ->whereHas(
                    'course',
                    fn ($query) => $query
                        ->has('coursesPrerequisites')
                        ->whereHas(
                            'department',
                            fn ($query) => $query
                                ->where(
                                    'id',
                                    $this->student->department_id
                                )
                        )
                )
                ->whereDoesntHave(
                    'studentCourseRegisterations',
                    fn ($query) => $query
                        ->where(
                            'student_id',
                            $this->student->id
                        )
                )
                ->take(2)
                ->get();

        $this
            ->assertNotEmpty(
                $student_department_courses,
            );

        $register_in_open_course_request =
            new RegisterInOpenCoursesRequestData(
                $student_department_courses->pluck('id')
                    ->toArray()
            );

        $response =
            $this
                ->postJsonData(
                    $register_in_open_course_request
                        ->toArray()
                );

        $response->assertStatus(422);

        $validation_message =
        __(
            'messages.open_coruse_registeraions.unfinished_required_prerequisites',
            [
                'courses_codes' => $student_department_courses
                    ->first()
                    ->course
                    ->coursesPrerequisites
                    ->pluck('code')
                    ->implode(','),
            ]
        );

        $response
            ->assertJsonValidationErrors(
                [
                    'open_courses_ids.0' => $validation_message,
                ]
            );

        $response
            ->assertJsonCount(2, 'errors');

    }

    #[Test]
    public function register_in_open_course_with_duplicate_registered_course_fails_validation_with_422_response(): void
    {

        $department_active_year_semester_id =
            DepartmentRegisterationPeriod::GetDepartmentActiveAcademicYearSemesterByDepartmentId(
                $this->student->department_id
            );

        $two_open_courses_this_year_semester =
            OpenCourseRegisteration::query()
                ->doesntHave('course.prerequisites')
                ->where(
                    'academic_year_semester_id',
                    $department_active_year_semester_id
                )
                ->take(2)
                ->get();

        $student = User::factory()
            ->staticStudent()
            ->fromItDepartment()
            ->withOpenCourses($two_open_courses_this_year_semester)
            ->create();

        $this->actingAs($student);

        $register_in_open_course_request =
            new RegisterInOpenCoursesRequestData(
                $two_open_courses_this_year_semester->pluck('id')
                    ->toArray()
            );

        $response =
            $this
                ->postJsonData(
                    $register_in_open_course_request
                        ->toArray()
                );

        $response->assertStatus(422);

        $validation_message =
            __(
                'messages.open_coruse_registeraions.duplicate_registered_course',
                [
                    'course_code' => $two_open_courses_this_year_semester
                        ->first()
                        ->course
                        ->code,

                ]
            );

        $response
            ->assertJsonValidationErrors(
                [
                    'open_courses_ids.0' => $validation_message,
                ]
            );

        $response
            ->assertJsonCount(2, 'errors');

    }

    // un_register_open_course
    #[Test]
    public function un_register_open_course_with_200_response(): void
    {

        $student_registered_open_course =
            OpenCourseRegisteration::query()
                ->whereHas(
                    'studentCourseRegisterations',
                    fn ($query) => $query
                        ->where(
                            'student_id',
                            $this->student->id
                        )
                )
                ->first();

        $response =
            $this
                ->withRoutePaths(
                    $student_registered_open_course
                        ->id
                )
                ->deleteJsonData();

        $user_has_unregistered_open_course =
            StudentCourseRegisteration::query()
                ->where(
                    [
                        'student_id' => $this->student->id,
                        'course_id' => $student_registered_open_course->id,
                    ]
                )
                ->first()
             ==
            null;

        $this
            ->assertTrue(
                $user_has_unregistered_open_course
            );

    }
}
