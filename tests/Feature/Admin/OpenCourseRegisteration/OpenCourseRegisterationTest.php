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
            // OpenCourseRegisterationSeeder::class,
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
            OpenCourseRegisteration::factory()
                ->create();

        $teacher =
            Teacher::factory()
                ->create();

        $open_course_id =
            $open_course
                ->id;

        $assign_a_teacher_to_an_open_course_request =
            new AssignTeacherToCourseRequestData(
                $teacher->id,
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
                    $assign_a_teacher_to_an_open_course_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                CourseTeacher::class,
                [
                    'course_id' => $assign_a_teacher_to_an_open_course_request->id,
                    'teacher_id' => $assign_a_teacher_to_an_open_course_request->teacher_id,
                ]
            );

        // Assert that mailable was queued with and view passed correct parameters
        Mail::assertQueued(
            TeacherCourseAssignmentEmail::class,
            function (TeacherCourseAssignmentEmail $mail) use ($open_course, $teacher) {

                return
                    $mail->course_name == $open_course->course->name
                    &&
                    $mail->teacher_name == $teacher->name;

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

        $new_course_teacher =
            CourseTeacher::factory()
                ->mainTeacher()
                ->create();

        $new_teacher =
            Teacher::factory()
                ->create();

        $assign_a_teacher_to_an_open_course_request =
            new AssignTeacherToCourseRequestData(
                $new_teacher->id,
                false,
                $new_course_teacher->course_id
            );

        $response =
            $this
                ->withRoutePaths(
                    $new_course_teacher->course->id,
                    'teachers',
                )
                ->postJsonData(
                    $assign_a_teacher_to_an_open_course_request
                        ->toArray()
                );

        $response
            ->assertStatus(200);

        $this
            ->assertDatabaseHas(
                CourseTeacher::class,
                [
                    'course_id' => $new_course_teacher->course_id,
                    'teacher_id' => $new_teacher->id,
                ]
            );

    }

    #[Test]
    public function assign_a_teacher_to_an_open_course_fails_only_one_main_teacher_per_course_validation_with_422_response(): void
    {

        $new_course_teacher =
            CourseTeacher::factory()
                ->mainTeacher()
                ->create();

        $new_teacher =
            Teacher::factory()
                ->create();

        $assign_a_teacher_to_an_open_course =
            new AssignTeacherToCourseRequestData(
                $new_teacher->id,
                true,
                $new_course_teacher->course_id
            );

        $response =
            $this
                ->withRoutePaths(
                    $new_course_teacher->course->id,
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

        $course =
            Course::factory()
                ->hasAttached(
                    Course::factory(),
                    [],
                    'firstCrossListed'
                )
                ->create();

        $course_data =
            new CourseData(
                $course->id,
                fake()->randomElement([200, 300, 400])
            );

        $open_course_registeration_request_data =
            OpenCourseForRegisterationRequestData::from([
                'department_id' => $course->department->id,
                'courses' => [
                    $course_data,
                ],
            ]);

        $response =
            $this
                ->postJsonData(
                    $open_course_registeration_request_data
                        ->toArray()
                );

        $response->assertStatus(200);

        Course::query()
            ->whereIn(
                'id',
                [$course->id]
            )
            ->get()
            ->concat(
                $course
                    ->firstCrossListed
            )
            ->each(function ($opened_course) use ($course_data) {
                $this
                    ->assertDatabaseHas(
                        OpenCourseRegisteration::class,
                        [
                            'course_id' => $opened_course->id,
                            'price_in_usd' => $course_data->price,
                        ]
                    );

            });

        $this
            ->assertDatabaseCount(
                OpenCourseRegisteration::class,
                2
            );

        $number_of_added_courses =
            1
            +
            $course->firstCrossListed->count();

        $this
            ->assertDatabaseCount(
                OpenCourseRegisteration::class,
                $number_of_added_courses
            );

    }

    // delete_an_existing_open_course
    #[Test]
    public function delete_an_existing_open_course_with_200_response(): void
    {

        $new_open_course_registeration =
            OpenCourseRegisteration::factory()
                ->create();

        $response =
             $this
                 ->withRoutePaths(
                     $new_open_course_registeration->id
                 )
                 ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                OpenCourseRegisteration::class,
                [
                    'id' => $new_open_course_registeration->id,
                ]
            );

    }
}
