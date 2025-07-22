<?php

namespace Tests\Feature\Admin\Admin;

use App\Data\Admin\ClassroomCourseTeacher\AssignClassroomToCourseTeacher\Request\AssignClassroomToCourseTeacherRequestData;
use App\Data\Admin\ClassroomCourseTeacher\UpdateCourseTeacherClassroom\Request\UpdateCourseTeacherClassroomRequestData;
use App\Models\Classroom;
use App\Models\ClassroomCourseTeacher;
use App\Models\CourseTeacher;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\ClassroomCourseTeacherSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CourseTeacherSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\TeacherSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class ClassroomCourseTeacherTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->route_builder
            ->withPaths('classroom-course-teachers');

        $this->seed([
            AcademicYearSemesterSeeder::class,
            DepartmentSeeder::class,
            ClassroomSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            OpenCourseRegisterationSeeder::class,
            CourseTeacherSeeder::class,
        ]);

    }

    #[Test]
    public function assign_classroom_to_course_with_200_response(): void
    {

        $this
            ->assertTrue(
                true
            );

        $assign_classroom_to_course_request =
            new AssignClassroomToCourseTeacherRequestData(
                Classroom::first()->id,
                CourseTeacher::first()->id,
                5,
                '12:00:00',
                '14:00:00'
            );

        $response =
            $this
                ->postJsonData(
                    $assign_classroom_to_course_request
                        ->toArray()
                );

        $response->assertStatus(200);

        ClassroomCourseTeacher::query()
            ->delete();

        $this
            ->assertTrue(
                true
            );

    }

    // fails because of rerunning the seeder before the test
    #[Test]
    public function assign_overlapped_classroom_to_course_fails_validation_with_422(): void
    {

        $this
            ->seed([
                ClassroomCourseTeacherSeeder::class,
            ]);

        $first_classroom_course_teacher =
            ClassroomCourseTeacher::first();

        $assign_classroom_to_course_request =
            new AssignClassroomToCourseTeacherRequestData(
                $first_classroom_course_teacher->classroom_id,
                $first_classroom_course_teacher->course_teacher_id,
                $first_classroom_course_teacher->day,
                $first_classroom_course_teacher->from,
                $first_classroom_course_teacher->to
            );

        $response =
            $this
                ->postJsonData(
                    $assign_classroom_to_course_request
                        ->toArray()
                );

        $response->assertStatus(422);

        info('hello world');

        $response
            ->assertOnlyJsonValidationErrors(

                ['from' => __('messages.classroom_course_teacher.overlap')]
            );

    }

    #[Test]
    public function delete_an_existing_classroom_course_teacher_with_200_response(): void
    {

        ClassroomCourseTeacher::factory()
            ->withCourseTeacherId(CourseTeacher::first()->id)
            ->withRandomFromTo()
            ->create();

        $first_classroom_course_teacher = ClassroomCourseTeacher::first();

        $response =
            $this
                ->withRoutePaths(
                    $first_classroom_course_teacher->id
                )
                ->deleteJsonData();

        $response->assertStatus(200);

        $open_course = ClassroomCourseTeacher::query()
            ->whereId($first_classroom_course_teacher->id)
            ->first();

        $this->assertNull($open_course);

    }

    #[Test]
    public function update_classroom_course_teacher_with_200_response(): void
    {

        $this
            ->seed([
                ClassroomCourseTeacherSeeder::class,
            ]);

        $request_day = 3;

        $request_from = '12:00:00';

        $request_to = '14:00:00';

        $random_classroom_course_teacher_to_update =
            ClassroomCourseTeacher::query()
                ->where(
                    'day',
                    '!=',
                    $request_day
                )
                ->where(
                    'from',
                    '!=',
                    $request_from
                )
                ->where(
                    'to',
                    '!=',
                    $request_to
                )
                ->inRandomOrder()
                ->first();

        $random_classroom_id =
            Classroom::first()
                ->where(
                    'id',
                    '!=',
                    $random_classroom_course_teacher_to_update->classroom_id
                )
                ->inRandomOrder()
                ->first()
                ->id;

        $random_course_teacher_id =
           CourseTeacher::first()
               ->where(
                   'id',
                   '!=',
                   $random_classroom_course_teacher_to_update->course_teacher_id
               )
               ->inRandomOrder()
               ->first()
               ->id;

        $update_classroom_course_teacher_request =
            new UpdateCourseTeacherClassroomRequestData(
                $random_classroom_id,
                $random_course_teacher_id,
                $request_day,
                $request_from,
                $request_to,
                $random_classroom_course_teacher_to_update->id
            );

        ClassroomCourseTeacher::query()
            ->where(
                'id',
                '!=',
                $update_classroom_course_teacher_request->id
            )
            ->where(
                'day',
                $update_classroom_course_teacher_request->day
            )
            ->where(
                'from',
                $update_classroom_course_teacher_request->from
            )
            ->where(
                'to',
                $update_classroom_course_teacher_request->to
            )
            ->where(
                'classroom_id',
                $update_classroom_course_teacher_request->classroom_id
            )
            ->delete();

        $response =
            $this
                ->withRoutePaths(
                    $random_classroom_course_teacher_to_update->id
                )
                ->patchJsonData(
                    $update_classroom_course_teacher_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $updated_classrom_course_teacher =
                $random_classroom_course_teacher_to_update
                    ->fresh();

        $this
            ->assertNotEquals(
                $updated_classrom_course_teacher->classroom_id,
                $random_classroom_course_teacher_to_update->classroom_id
            );

        $this
            ->assertNotEquals(
                $updated_classrom_course_teacher->course_teacher_id,
                $random_classroom_course_teacher_to_update->course_teacher_id
            );

        $this
            ->assertNotEquals(
                $updated_classrom_course_teacher->day,
                $random_classroom_course_teacher_to_update->day
            );

        $this
            ->assertNotEquals(
                $updated_classrom_course_teacher->from,
                $random_classroom_course_teacher_to_update->from
            );

        $this
            ->assertNotEquals(
                $updated_classrom_course_teacher->to,
                $random_classroom_course_teacher_to_update->to
            );

    }

    #[Test]
    public function update_overlapped_classroom_course_teacher_fails_validation_with_422(): void
    {

        $this
            ->seed([
                ClassroomCourseTeacherSeeder::class,
            ]);

        $random_classroom_course_teacher_to_update =
            ClassroomCourseTeacher::query()
                ->first();

        $classroom_course_teacher_to_overlapp_with_to_update_one =
            ClassroomCourseTeacher::query()
                ->where(
                    'id',
                    '!=',
                    $random_classroom_course_teacher_to_update->id
                )
                ->inRandomOrder()
                ->first();

        $update_classroom_course_teacher_request =
            new UpdateCourseTeacherClassroomRequestData(
                $classroom_course_teacher_to_overlapp_with_to_update_one->classroom_id,
                $classroom_course_teacher_to_overlapp_with_to_update_one->course_teacher_id,
                $classroom_course_teacher_to_overlapp_with_to_update_one->day,
                $classroom_course_teacher_to_overlapp_with_to_update_one->from,
                $classroom_course_teacher_to_overlapp_with_to_update_one->to,
                $random_classroom_course_teacher_to_update->id
            );

        $response =
            $this
                ->withRoutePaths(
                    $random_classroom_course_teacher_to_update->id
                )
                ->patchJsonData(
                    $update_classroom_course_teacher_request
                        ->toArray()
                );

        $response
            ->assertOnlyJsonValidationErrors(

                ['from' => __('messages.classroom_course_teacher.overlap')]
            );

    }
}
