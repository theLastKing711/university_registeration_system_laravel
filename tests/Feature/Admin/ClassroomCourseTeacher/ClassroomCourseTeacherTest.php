<?php

namespace Tests\Feature\Admin\Admin;

use App\Data\Admin\ClassroomCourseTeacher\AssignClassroomToCourseTeacher\Request\AssignClassroomToCourseTeacherRequestData;
use App\Data\Admin\ClassroomCourseTeacher\UpdateCourseTeacherClassroom\Request\UpdateCourseTeacherClassroomRequestData;
use App\Models\Classroom;
use App\Models\ClassroomCourseTeacher;
use App\Models\CourseTeacher;
use Database\Seeders\AcademicYearSemesterSeeder;
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

        $new_classroom_course_teacher =
            ClassroomCourseTeacher::factory()
                ->withCourseTeacherId(CourseTeacher::first()->id)
                ->withRandomFromTo()
                ->create();

        $assign_classroom_to_course_request =
            new AssignClassroomToCourseTeacherRequestData(
                $new_classroom_course_teacher->classroom_id,
                $new_classroom_course_teacher->course_teacher_id,
                $new_classroom_course_teacher->day,
                $new_classroom_course_teacher->from,
                $new_classroom_course_teacher->to
            );

        $response =
            $this
                ->postJsonData(
                    $assign_classroom_to_course_request
                        ->toArray()
                );

        $response->assertStatus(422);

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

        $new_classroom_course_teacher =
            ClassroomCourseTeacher::factory()
                ->withRandomFromTo()
                ->create();

        $request_day = 3;

        $request_from = '12:00:00';

        $request_to = '14:00:00';

        $update_classroom_course_teacher_request =
            new UpdateCourseTeacherClassroomRequestData(
                $new_classroom_course_teacher->classroom_id,
                $new_classroom_course_teacher->course_teacher_id,
                $request_day,
                $request_from,
                $request_to,
                $new_classroom_course_teacher->id
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
                    $new_classroom_course_teacher->id
                )
                ->patchJsonData(
                    $update_classroom_course_teacher_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                ClassroomCourseTeacher::class,
                [
                    'id' => $update_classroom_course_teacher_request->id,
                    'classroom_id' => $update_classroom_course_teacher_request->classroom_id,
                    'course_teacher_id' => $update_classroom_course_teacher_request->course_teacher_id,
                    'day' => $update_classroom_course_teacher_request->day,
                    'from' => $update_classroom_course_teacher_request->from,
                    'to' => $update_classroom_course_teacher_request->to,
                ]
            );

    }

    #[Test]
    public function update_overlapped_classroom_course_teacher_fails_validation_with_422(): void
    {

        $random_classroom_course_teacher_to_update =
            ClassroomCourseTeacher::factory()
                ->withRandomFromTo()
                ->create();

        $classroom_course_teacher_to_conflict_with =
            ClassroomCourseTeacher::factory()
                ->withRandomFromTo()
                ->create();

        $update_classroom_course_teacher_request =
            new UpdateCourseTeacherClassroomRequestData(
                $classroom_course_teacher_to_conflict_with->classroom_id,
                $classroom_course_teacher_to_conflict_with->course_teacher_id,
                $classroom_course_teacher_to_conflict_with->day,
                $classroom_course_teacher_to_conflict_with->from,
                $classroom_course_teacher_to_conflict_with->to,
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

        $response->assertStatus(422);

        $response
            ->assertOnlyJsonValidationErrors(

                ['from' => __('messages.classroom_course_teacher.overlap')]
            );

    }

    #[Test]
    public function update_overlapped_classroom_course_teacher_success_validation_when_same_record_overlap_with_itself_with_200(): void
    {

        $classroom_course_teacher_to_update =
            ClassroomCourseTeacher::factory()
                ->withRandomFromTo()
                ->create();

        $update_classroom_course_teacher_request =
            new UpdateCourseTeacherClassroomRequestData(
                $classroom_course_teacher_to_update->classroom_id,
                $classroom_course_teacher_to_update->course_teacher_id,
                $classroom_course_teacher_to_update->day,
                $classroom_course_teacher_to_update->from,
                $classroom_course_teacher_to_update->to,
                $classroom_course_teacher_to_update->id
            );

        $response =
            $this
                ->withRoutePaths(
                    $classroom_course_teacher_to_update->id
                )
                ->patchJsonData(
                    $update_classroom_course_teacher_request
                        ->toArray()
                );

        $response
            ->assertStatus(200);

    }
}
