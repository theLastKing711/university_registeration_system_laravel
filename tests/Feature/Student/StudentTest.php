<?php

namespace Tests\Feature\Student;

use App\Data\Student\OpenCourseRegisteration\RegisterCourses\Request\RegisterInOpenCoursesRequestData;
use App\Models\DepartmentRegisterationPeriod;
use App\Models\OpenCourseRegisteration;
use App\Models\StudentCourseRegisteration;
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

    // get_teachers
    #[Test]
    public function get_open_courses_this_semester_with_200_response(): void
    {

        $response =
            $this
                ->getJsonData();

        $response
            ->assertStatus(200);
    }

    // get_teachers
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

    // register_in_open_course
    #[Test]
    public function register_in_open_course_with_200_response(): void
    {

        $student_department_courses_ids =
            OpenCourseRegisteration::query()
                ->doesntHave('course.coursesPrerequisites')
                ->whereHas(
                    'course',
                    fn ($query) => $query
                        ->whereHas(
                            'department',
                            fn ($query) => $query
                                ->where(
                                    'id',
                                    $this->student->department_id
                                )
                        )
                )
                ->take(2)
                ->get()
                ->pluck('id');

        $register_in_open_course_request =
            new RegisterInOpenCoursesRequestData(
                $student_department_courses_ids
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

        $department_registeration_period =
            DepartmentRegisterationPeriod::query()
                ->where(
                    [
                        'department_id' => $this->student->department_id,
                        'is_open_for_students' => true,
                    ]
                )
                ->first();

        $student_department_courses =
            OpenCourseRegisteration::query()
                ->where(
                    'academic_year_semester_id',
                    $department_registeration_period
                        ->academic_year_semester_id
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

    // un_register_open_course
    #[Test]
    public function un_register_open_course_with_200_response(): void
    {

        $student_registered_open_course =
            StudentCourseRegisteration::query()
                ->with('course')
                ->firstWhere(
                    'student_id',
                    $this->student->id
                );

        $response =
            $this
                ->withRoutePaths(
                    $student_registered_open_course
                        ->course
                        ->id
                )
                ->deleteJsonData();

        $student_registered_open_course_after_request =
            $student_registered_open_course->fresh();

        $open_course_has_been_deleted =
            $student_registered_open_course_after_request
             ===
            null;

        $this
            ->assertTrue(
                $open_course_has_been_deleted
            );

    }

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
}
