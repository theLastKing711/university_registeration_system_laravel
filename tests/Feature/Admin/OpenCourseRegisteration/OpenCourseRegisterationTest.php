<?php

namespace Tests\Feature\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\AssignTeacherToCourse\Request\AssignTeacherToCourseRequestData;
use App\Data\Admin\OpenCourseRegisteration\OpenCourseForRegisteration\Request\CourseData;
use App\Data\Admin\OpenCourseRegisteration\OpenCourseForRegisteration\Request\OpenCourseForRegisterationRequestData;
use App\Mail\TeacherCourseAssignmentEmail;
use App\Models\Course;
use App\Models\CourseTeacher;
use App\Models\OpenCourseRegisteration;
use App\Models\Teacher;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\DepartmentRegisterationPeriodSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\UsdCurrencyExchangeRateSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class OpenCourseRegisterationTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths(
                'open-course-registerations'
            );

        $this->seed([
            AcademicYearSemesterSeeder::class,
            DepartmentSeeder::class,
            ClassroomSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            OpenCourseRegisterationSeeder::class,
            DepartmentRegisterationPeriodSeeder::class,
            UsdCurrencyExchangeRateSeeder::class,
        ]);

    }

    // assign_a_teacher_to_an_open_course
    // Laravel automatically sets the QUEUE_CONNECTION to sync when running tests via phpunit
    #[Test]
    public function assign_a_teacher_to_an_open_course_with_200_response(): void
    {

        Mail::fake();

        $open_course =
            OpenCourseRegisteration::first();

        $teacher_to_assign_course_to =
            Teacher::first();

        $open_course_id =
            $open_course
                ->id;

        $assign_a_teacher_to_an_open_course =
            new AssignTeacherToCourseRequestData(
                $teacher_to_assign_course_to->id,
                false,
                $open_course_id
            );

        $response =
            $this
                ->withRoutePaths(
                    $open_course_id,
                    'teachers'
                )
                ->postJsonData(
                    $assign_a_teacher_to_an_open_course
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_open_courses =
            CourseTeacher::query()
                ->where(
                    'course_id',
                    $assign_a_teacher_to_an_open_course->id,
                )
                ->where(
                    'teacher_id',
                    $assign_a_teacher_to_an_open_course->teacher_id
                )
                ->get();

        $this->assertCount(1, $created_open_courses);

        // Assert that mailable was queued with and view passed correct parameters
        Mail::assertQueued(
            TeacherCourseAssignmentEmail::class,
            function (TeacherCourseAssignmentEmail $mail) use ($open_course, $teacher_to_assign_course_to) {

                return
                    $mail->course_name == $open_course->course->name
                    &&
                    $mail->teacher_name == $teacher_to_assign_course_to->name;

            }
        );

        Mail::assertQueuedCount(1);

    }

    // un_assign_a_teacher_from_an_open_course
    #[Test]
    public function un_assign_a_teacher_from_an_open_course_with_200_response(): void
    {

        /** @var CourseTeacher $course_teacher */
        $course_teacher =
            CourseTeacher::factory()
                ->create();

        $response =
            $this
                ->withRoutePaths(
                    $course_teacher->course_id,
                    'teachers',
                )
                ->withArrayQueryParameter(
                    [$course_teacher->teacher_id],
                    'teachers_ids'
                )
                ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                CourseTeacher::class,
                [
                    'teacher_id' => $course_teacher->id,
                    'course_id' => $course_teacher->course_id,
                    'is_main_teacher' => $course_teacher->is_main_teacher,
                ]
            );

    }

    #[Test]
    public function assign_a_teacher_to_an_open_course_success_with_one_main_teacher_and_one_non_main_teacher_with_200_response(): void
    {

        $open_course_id =
            OpenCourseRegisteration::query()
                ->first()
                ->id;

        $main_teacher_same_open_course_conflicted_course_teacher =
            CourseTeacher::factory()
                ->mainTeacher()
                ->withCourseId($open_course_id)
                ->withTeacherId(
                    teacher_id: Teacher::query()->inRandomOrder()->first()->id
                )
                ->create();

        $assign_a_teacher_to_an_open_course =
            new AssignTeacherToCourseRequestData(
                Teacher::inRandomOrder()->first()->id,
                false,
                $main_teacher_same_open_course_conflicted_course_teacher->course_id
            );

        $response =
            $this
                ->withRoutePaths(
                    $open_course_id,
                    'teachers',
                )
                ->postJsonData(
                    $assign_a_teacher_to_an_open_course
                        ->toArray()
                );

        $response
            ->assertStatus(200);

    }

    #[Test]
    public function assign_a_teacher_to_an_open_course_fails_only_one_main_teacher_per_course_validation_with_422_response(): void
    {

        $open_course_id =
            OpenCourseRegisteration::query()
                ->first()
                ->id;

        $main_teacher_same_open_course_conflicted_course_teacher =
            CourseTeacher::factory()
                ->mainTeacher()
                ->withCourseId($open_course_id)
                ->withTeacherId(
                    teacher_id: Teacher::query()->inRandomOrder()->first()->id
                )
                ->create();

        $assign_a_teacher_to_an_open_course =
            new AssignTeacherToCourseRequestData(
                Teacher::inRandomOrder()->first()->id,
                true,
                $main_teacher_same_open_course_conflicted_course_teacher->course_id
            );

        $response =
            $this
                ->withRoutePaths(
                    $open_course_id,
                    'teachers',
                )
                ->postJsonData(
                    $assign_a_teacher_to_an_open_course
                        ->toArray()
                );

        $response
            ->assertStatus(422);

        $response
            ->assertOnlyJsonValidationErrors(
                [
                    'teacher_id' => __(
                        'messages.course_teacher.only_one_main_teacher_per_open_course'
                    ),
                ]
            );

    }

    // open_course_for_registeration
    #[Test]
    public function open_course_for_registeration_and_open_related_cross_listed_courses_with_200_response(): void
    {

        $course_that_has_cross_one_listed_course =
            Course::query()
                ->with('department.openedAcademicyears')
                ->whereHas(
                    'department',
                    fn (Builder $query) => $query
                        ->has(
                            'openedAcademicyears',

                        )
                )
                ->has('firstCrossListedCourses', 1)
                // ->orHas('SecondCrossListedCourses', 1)
                ->first();

        $before_course_open_count = OpenCourseRegisteration::count();

        $open_course_registeration_request_data =
            OpenCourseForRegisterationRequestData::from([
                'academic_year_semester_id' => $course_that_has_cross_one_listed_course->department->openedAcademicyears->first()->id,
                'department_id' => $course_that_has_cross_one_listed_course->department->id,
                'courses' => [
                    new CourseData(
                        $course_that_has_cross_one_listed_course->id,
                        fake()->randomElement([200, 300, 400])
                    ),
                ],
            ]);

        $response =
            $this
                ->postJsonData(
                    $open_course_registeration_request_data
                        ->toArray()
                );

        $response->assertStatus(200);

        $after_course_open_count = OpenCourseRegisteration::count();

        $number_of_added_courses = 2;

        $two_courses_has_been_registered =
                    $before_course_open_count + $number_of_added_courses
                    ==
                    $after_course_open_count;
        $this
            ->assertTrue(
                $two_courses_has_been_registered
            );

    }

    // delete_an_existing_open_course
    #[Test]
    public function delete_an_existing_open_course_with_200_response(): void
    {

        $open_course_registeration =
            OpenCourseRegisteration::first();

        $response =
             $this
                 ->withRoutePaths(
                     $open_course_registeration->id
                 )
                 ->deleteJsonData();

        $response->assertStatus(200);

        $open_course =
            $open_course_registeration
                ->fresh();

        $this->assertNull($open_course);

    }
}
