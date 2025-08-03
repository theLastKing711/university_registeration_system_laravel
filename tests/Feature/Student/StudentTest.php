<?php

namespace Tests\Feature\Student;

use App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Response\GetCoursesMarksResponsePaginationResultData;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarksThisSemester\Respone\GetCoursesMarksThisSemesterResponseData;
use App\Data\Student\OpenCourseRegisteration\GetCoursesScheduleThisSemester\Response\GetCoursesScheduleThisSemesterResponseData;
use App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemester\Response\GetStudentRegisteredOpenCoursesThisSemesterResponsePaginationResultData;
use App\Data\Student\OpenCourseRegisteration\RegisterCourses\Request\RegisterInOpenCoursesRequestData;
use App\Models\AcademicYearSemester;
use App\Models\ClassroomCourseTeacher;
use App\Models\Course;
use App\Models\CourseTeacher;
use App\Models\Department;
use App\Models\OpenCourseRegisteration;
use App\Models\StudentCourseRegisteration;
use App\Models\Teacher;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Traits\CloudUploadServiceMocks;
use Tests\Feature\Student\Abstractions\StudentTestCase;

class StudentTest extends StudentTestCase
{
    use CloudUploadServiceMocks;

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

        $academic_year_semester =
            AcademicYearSemester::factory()
                ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->has(
                    Course::factory(3)
                        ->has(
                            OpenCourseRegisteration::factory(3)
                                ->withAcadeicYearSemesterId(
                                    $academic_year_semester->id
                                ),
                            'openCourseRegisterations'
                        )
                )
                ->create();

        $open_courses =
                $department
                    ->courses
                    ->pluck('openCourseRegisterations')
                    ->flatten(1);

        $student = User::factory()
            ->withDepartmentId($department->id)
            ->withStudentRole()
            ->hasAttached(
                $open_courses,
                [],
                'courses'
            )
            ->create();

        $this->actingAs($student);

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

        $academic_year_semester =
          AcademicYearSemester::factory()
              ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->create();

        $teacher_per_course =
            2;

        $classroom_per_course_teacher =
         2;

        $courses =
            Course::factory(3)
                ->for($department)
                ->has(
                    OpenCourseRegisteration::factory()
                        ->withAcadeicYearSemesterId(
                            $academic_year_semester->id
                        )
                        ->has(
                            CourseTeacher::factory($teacher_per_course)
                                ->has(
                                    ClassroomCourseTeacher::factory($classroom_per_course_teacher),
                                    'classroomCourseTeachers'
                                ),
                            'courseTeachers'
                        ),
                    'openCourseRegisterations'
                )
                ->create();

        $open_courses =
            $courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $student_courses =
            $open_courses
                ->take(2);

        $student = User::factory()
            ->for($department)
            ->withStudentRole()
            ->hasAttached(
                $student_courses,
                [],
                'courses'
            )
            ->create();

        $this->actingAs($student);

        $response =
            $this
                ->withRoutePaths(
                    'schedule'
                )
                ->getJsonData();

        $response->assertStatus(200);

        $getCoursesScheduleThisSemesterResponseData =
            collect(
                GetCoursesScheduleThisSemesterResponseData::collect(
                    $response->json()
                )
            );

        $course_schedule_count =
            $student_courses->count()
            *
            $teacher_per_course
            *
            $classroom_per_course_teacher;

        $this->assertCount(
            $course_schedule_count,
            $getCoursesScheduleThisSemesterResponseData
        );

    }

    // get_student_open_course_marks
    #[Test]
    public function get_student_open_course_marks_with_200_response(): void
    {

        $academic_year_semester =
          AcademicYearSemester::factory()
              ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->create();

        $teacher_per_course =
            2;

        $classroom_per_course_teacher =
         2;

        $courses =
            Course::factory(3)
                ->for($department)
                ->has(
                    OpenCourseRegisteration::factory()
                        ->withAcadeicYearSemesterId(
                            $academic_year_semester->id
                        )
                        ->has(
                            CourseTeacher::factory($teacher_per_course)
                                ->has(
                                    ClassroomCourseTeacher::factory($classroom_per_course_teacher),
                                    'classroomCourseTeachers'
                                ),
                            'courseTeachers'
                        ),
                    'openCourseRegisterations'
                )
                ->create();

        $open_courses =
            $courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $student_courses =
            $open_courses
                ->take(2);

        $student = User::factory()
            ->for($department)
            ->withStudentRole()
            ->hasAttached(
                $student_courses,
                fn ($attributes) => ['final_mark' => fake()->numberBetween(30, 70)],
                'courses'
            )
            ->create();

        $this->actingAs($student);

        $response =
            $this
                ->withRoutePaths(
                    'marks'
                )
                ->getJsonData();

        $response
            ->assertStatus(200);

        $response_data =
                    GetCoursesMarksResponsePaginationResultData::from(
                        $response->json()
                    );

        $this
            ->assertCount(
                $response_data->data->count(),
                $student_courses
            );

    }

    // get_student_marks_this_semester
    #[Test]
    public function get_student_course_marks_this_semester_with_200_response(): void
    {

        $academic_year_semester =
          AcademicYearSemester::factory()
              ->withYearSemster(2014, 0)
              ->create();

        $previous_academic_year_semester =
          AcademicYearSemester::factory()
              ->withYearSemster(2014, 1)
              ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->hasAttached(
                    $previous_academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => false],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->create();

        $teacher_per_course =
            2;

        $classroom_per_course_teacher =
         2;

        $courses =
            Course::factory(3)
                ->for($department)
                ->has(
                    OpenCourseRegisteration::factory()
                        ->withAcadeicYearSemesterId(
                            $academic_year_semester->id
                        )
                        ->has(
                            CourseTeacher::factory($teacher_per_course)
                                ->has(
                                    ClassroomCourseTeacher::factory($classroom_per_course_teacher),
                                    'classroomCourseTeachers'
                                ),
                            'courseTeachers'
                        ),
                    relationship: 'openCourseRegisterations'
                )
                ->create();

        $previouse_year_semester_courses =
         Course::factory(3)
             ->for($department)
             ->has(
                 OpenCourseRegisteration::factory()
                     ->withAcadeicYearSemesterId(
                         $previous_academic_year_semester->id
                     )
                     ->has(
                         CourseTeacher::factory($teacher_per_course)
                             ->has(
                                 ClassroomCourseTeacher::factory($classroom_per_course_teacher),
                                 'classroomCourseTeachers'
                             ),
                         'courseTeachers'
                     ),
                 relationship: 'openCourseRegisterations'
             )
             ->create();

        $open_courses =
            $courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $previous_year_semster_open_courses =
            $previouse_year_semester_courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $current_year_semester_courses =
            $open_courses
                ->take(2);

        $previous_year_semester_courses =
            $previous_year_semster_open_courses
                ->take(3);

        $student_courses =
            $current_year_semester_courses
                ->concat(
                    $previous_year_semester_courses
                );

        $student = User::factory()
            ->for($department)
            ->withStudentRole()
            ->hasAttached(
                $student_courses,
                fn ($attributes) => ['final_mark' => fake()->numberBetween(30, 70)],
                'courses'
            )
            ->create();

        $this->actingAs($student);

        $response =
            $this
                ->withRoutePaths(
                    'marks',
                    'this-semester',
                )
                ->getJsonData();

        $response
            ->assertStatus(200);

        $getCoursesMarksThisSemesterResponseData =
            collect(
                GetCoursesMarksThisSemesterResponseData::collect(
                    $response->json()
                )
            );

        $this->assertCount(
            $getCoursesMarksThisSemesterResponseData->count(),
            $current_year_semester_courses
        );
    }

    // get_student_registered_open_courses_this_semester
    #[Test]
    public function get_student_registered_open_courses_this_semester_with_200_response(): void
    {

        $academic_year_semester =
          AcademicYearSemester::factory()
              ->withYearSemster(2014, 0)
              ->create();

        $previous_academic_year_semester =
          AcademicYearSemester::factory()
              ->withYearSemster(2014, 1)
              ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->hasAttached(
                    $previous_academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => false],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->create();

        $teacher_per_course =
            2;

        $classroom_per_course_teacher =
         2;

        $courses =
            Course::factory(3)
                ->for($department)
                ->has(
                    OpenCourseRegisteration::factory()
                        ->withAcadeicYearSemesterId(
                            $academic_year_semester->id
                        )
                        ->has(
                            CourseTeacher::factory($teacher_per_course)
                                ->has(
                                    ClassroomCourseTeacher::factory($classroom_per_course_teacher),
                                    'classroomCourseTeachers'
                                ),
                            'courseTeachers'
                        ),
                    relationship: 'openCourseRegisterations'
                )
                ->create();

        $previouse_year_semester_courses =
         Course::factory(3)
             ->for($department)
             ->has(
                 OpenCourseRegisteration::factory()
                     ->withAcadeicYearSemesterId(
                         $previous_academic_year_semester->id
                     )
                     ->has(
                         CourseTeacher::factory($teacher_per_course)
                             ->has(
                                 ClassroomCourseTeacher::factory($classroom_per_course_teacher),
                                 'classroomCourseTeachers'
                             ),
                         'courseTeachers'
                     ),
                 relationship: 'openCourseRegisterations'
             )
             ->create();

        $open_courses =
            $courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $previous_year_semster_open_courses =
            $previouse_year_semester_courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $current_year_semester_courses =
            $open_courses
                ->take(2);

        $previous_year_semester_courses =
            $previous_year_semster_open_courses
                ->take(3);

        $student_courses =
            $current_year_semester_courses
                ->concat(
                    $previous_year_semester_courses
                );

        $student = User::factory()
            ->for($department)
            ->withStudentRole()
            ->hasAttached(
                $student_courses,
                fn ($attributes) => ['final_mark' => fake()->numberBetween(30, 70)],
                'courses'
            )
            ->create();

        $this->actingAs($student);

        $response =
            $this
                ->withRoutePaths(
                    'registered-courses',
                    'this-semester'
                )
                ->getJsonData();

        $response
            ->assertStatus(200);

        $getStudentRegisteredOpenCoursesThisSemesterResponsePaginationResultData =
           GetStudentRegisteredOpenCoursesThisSemesterResponsePaginationResultData::from(
               $response->json()
           );

        $response_data =
                $getStudentRegisteredOpenCoursesThisSemesterResponsePaginationResultData
                    ->data;

        $this->assertCount(
            $response_data->count(),
            $current_year_semester_courses
        );
    }

    // register_in_open_course
    #[Test]
    public function register_in_open_course_with_200_response(): void
    {
        $academic_year_semester =
          AcademicYearSemester::factory()
              ->withYearSemster(2014, 0)
              ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->create();

        $courses =
            Course::factory(count: 3)
                ->for($department)
                ->has(
                    OpenCourseRegisteration::factory()
                        ->withAcadeicYearSemesterId(
                            $academic_year_semester->id
                        ),
                    relationship: 'openCourseRegisterations'
                )
                ->create();

        $open_courses =
            $courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $current_year_semester_courses =
            $open_courses
                ->take(2);

        $student_courses =
            $current_year_semester_courses;

        $student = User::factory()
            ->for($department)
            ->withStudentRole()
            ->create();

        $this->actingAs($student);

        $register_in_open_course_request =
            new RegisterInOpenCoursesRequestData(
                $student_courses->pluck('id')
                    ->toArray()
            );

        $response =
            $this
                ->postJsonData(
                    $register_in_open_course_request
                        ->toArray()
                );

        $response->assertStatus(200);

        foreach ($register_in_open_course_request->open_courses_ids as $key => $open_course_id) {
            $this
                ->assertDatabaseHas(
                    StudentCourseRegisteration::class,
                    [
                        'student_id' => $student->id,
                        'course_id' => $open_course_id,
                    ]
                );
        }

    }

    #[Test]
    public function register_in_open_course_with_unfinished_required_prerequisites_fails_validation_with_422_response(): void
    {

        $academic_year_semester =
         AcademicYearSemester::factory()
             ->withYearSemster(2014, 0)
             ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->create();

        $courses =
            Course::factory(count: 3)
                ->for($department)
                ->hasAttached(
                    Course::factory(),
                    [],
                    'coursesPrerequisites'
                )
                ->has(
                    OpenCourseRegisteration::factory()
                        ->withAcadeicYearSemesterId(
                            $academic_year_semester->id
                        ),
                    relationship: 'openCourseRegisterations'
                )
                ->create();

        $open_courses =
            $courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $current_year_semester_courses =
            $open_courses
                ->take(2);

        $student_courses =
            $current_year_semester_courses;

        $student = User::factory()
            ->for($department)
            ->withStudentRole()
            ->create();

        $this->actingAs($student);

        $register_in_open_course_request =
            new RegisterInOpenCoursesRequestData(
                $student_courses->pluck('id')
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
                'courses_codes' => $student_courses
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

        $academic_year_semester =
         AcademicYearSemester::factory()
             ->withYearSemster(2014, 0)
             ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->create();

        $courses =
            Course::factory(count: 3)
                ->for($department)
                ->has(
                    OpenCourseRegisteration::factory()
                        ->withAcadeicYearSemesterId(
                            $academic_year_semester->id
                        ),
                    relationship: 'openCourseRegisterations'
                )
                ->create();

        $open_courses =
            $courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $duplicated_open_course =
            $open_courses
                ->take(1);

        $current_year_semester_courses =
            $duplicated_open_course
                ->concat(
                    $duplicated_open_course
                );

        $student_courses =
            $current_year_semester_courses;

        $student = User::factory()
            ->for($department)
            ->withStudentRole()
            ->create();

        $this->actingAs($student);

        $register_in_open_course_request =
            new RegisterInOpenCoursesRequestData(
                $student_courses->pluck('id')
                    ->toArray()
            );

        $response =
            $this
                ->postJsonData(
                    $register_in_open_course_request
                        ->toArray()
                );

        $register_in_open_course_request =
            new RegisterInOpenCoursesRequestData(
                $student_courses->pluck('id')
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
                    'course_code' => $student_courses
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

        $academic_year_semester =
         AcademicYearSemester::factory()
             ->withYearSemster(2014, 0)
             ->create();

        $department =
            Department::factory()
                ->hasAttached(
                    $academic_year_semester,
                    fn ($attributes) => ['is_open_for_students' => true],
                    'openedAcademicyears'
                )
                ->has(
                    Teacher::factory(10),
                    'teachers'
                )
                ->create();

        $courses =
            Course::factory(count: 3)
                ->for($department)
                ->has(
                    OpenCourseRegisteration::factory()
                        ->withAcadeicYearSemesterId(
                            $academic_year_semester->id
                        ),
                    relationship: 'openCourseRegisterations'
                )
                ->create();

        $open_courses =
            $courses
                ->pluck('openCourseRegisterations')
                ->flatten(1);

        $current_year_semester_courses =
            $open_courses
                ->take(2);

        $student_courses =
            $current_year_semester_courses;

        /** @var OpenCourseRegisteration $open_course_to_unregister description */
        $open_course_to_unregister =
            $student_courses
                ->first();

        $student = User::factory()
            ->for($department)
            ->withStudentRole()
            ->create();

        $this->actingAs($student);

        $response =
            $this
                ->withRoutePaths(
                    $open_course_to_unregister
                        ->id
                )
                ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                StudentCourseRegisteration::class,
                [
                    'student_id' => $student->id,
                    'course_id' => $open_course_to_unregister->id,
                ]
            );

    }
}
