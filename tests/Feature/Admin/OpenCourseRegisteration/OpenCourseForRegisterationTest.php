<?php

namespace Tests\Feature\Admin;

use App\Data\Admin\OpenCourseRegisteration\AssignTeacherToCourse\Request\AssignTeacherToCourseRequestData;
use App\Data\Admin\OpenCourseRegisteration\OpenCourseForRegisteration\Request\OpenCourseForRegisterationRequestData;
use App\Models\CourseTeacher;
use App\Models\OpenCourseRegisteration;
use Barryvdh\Debugbar\Facades\Debugbar;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\DepartmentRegisterationPeriodSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\TeacherSeeder;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;
use Tests\Feature\Admin\Traits\MediaMockTrait;

class OpenCourseForRegisterationTest extends AdminTestCase
{
    use MediaMockTrait;

    private string $main_route = '/admins/open-course-registerations';

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
            DepartmentRegisterationPeriodSeeder::class,
        ]);

    }

    #[Test]
    public function assign_a_teacher_to_an_open_course_with_201_response(): void
    {

        CourseTeacher::query()
            ->delete();

        $assign_a_teacher_to_an_open_course =
            new AssignTeacherToCourseRequestData(
                1,
                1,
                1
            );

        $assign_a_teacher_to_an_open_course_route = $this->main_route.'/teachers';

        $response =
            $this
                ->post(
                    $assign_a_teacher_to_an_open_course_route,
                    $assign_a_teacher_to_an_open_course
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_open_courses =
            CourseTeacher::query()
                ->where(
                    'course_id',
                    $assign_a_teacher_to_an_open_course->course_id,
                )
                ->where(
                    'teacher_id',
                    $assign_a_teacher_to_an_open_course->teacher_id
                )
                ->get();

        $this->assertCount(1, $created_open_courses);

    }

    #[Test]
    public function open_course_for_registeration_and_open_related_cross_listed_courses_with_201_response(): void
    {

        Log::info('testing from tests');

        Debugbar::log('hello world from test');

        $open_course_registeration_request_data =
            OpenCourseForRegisterationRequestData::from([
                'academic_year_semester_id' => 7,
                'department_id' => 1,
                'courses_ids' => [1, 2],
            ]);

        $response =
            $this
                ->post(
                    $this->main_route,
                    $open_course_registeration_request_data
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_open_courses =
            OpenCourseRegisteration::query()
                ->where(
                    'academic_year_semester_id',
                    $open_course_registeration_request_data
                        ->academic_year_semester_id
                )
                ->whereIn(
                    'course_id',
                    $open_course_registeration_request_data
                        ->courses_ids
                )
                ->get();

        $this->assertCount(2, $created_open_courses);

    }

    #[Test]
    public function destroy_delete_an_existing_open_course_with_200_response(): void
    {

        $open_course_registeration = OpenCourseRegisteration::first();

        $show_route = $this->main_route.'/'.$open_course_registeration->id;

        $response = $this->delete($show_route);

        $response->assertStatus(200);

        $open_course = OpenCourseRegisteration::query()
            ->whereId($open_course_registeration->id)
            ->first();

        $this->assertNull($open_course);

    }
}
