<?php

namespace Tests\Feature\Admin\Admin;

use App\Data\Admin\ClassroomCourseTeacher\AssignClassroomToCourseTeacher\Request\AssignClassroomToCourseTeacherRequestData;
use App\Models\ClassroomCourseTeacher;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CourseTeacherSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\TeacherSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;
use Tests\Feature\Admin\Traits\MediaMockTrait;

class ClassroomCourseTeacherTest extends AdminTestCase
{
    use MediaMockTrait;

    private string $main_route = '/admins/classroom-course-teachers';

    protected function setUp(): void
    {
        parent::setUp();

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
    public function assign_classroom_to_course_with_201_response(): void
    {

        ClassroomCourseTeacher::query()
            ->delete();

        $this
            ->assertTrue(
                true
            );

        $assign_classroom_to_course_request =
            new AssignClassroomToCourseTeacherRequestData(
                4,
                1,
                5,
                '12:00:00',
                '14:00:00'
            );

        $response =
            $this
                ->postJson(
                    $this->main_route,
                    $assign_classroom_to_course_request
                        ->toArray()
                );

        $response->assertStatus(200);

    }

    #[Test]
    public function assign_overlapped_classroom_to_course_fail_validation(): void
    {

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
                ->postJson(
                    $this->main_route,
                    $assign_classroom_to_course_request
                        ->toArray()
                );

        // $response->assertStatus(30);

        info('hello world');

        $response
            ->assertOnlyJsonValidationErrors(
                ['from' => 'يوحد تضارب في يوم وتوقيت الحصة, يرجى اختيار وقت ويوم آخر.']
            );

    }
}
