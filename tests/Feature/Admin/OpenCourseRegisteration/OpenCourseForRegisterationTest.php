<?php

namespace Tests\Feature\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\AssignTeacherToCourse\Request\AssignTeacherToCourseRequestData;
use App\Data\Admin\OpenCourseRegisteration\OpenCourseForRegisteration\Request\OpenCourseForRegisterationRequestData;
use App\Models\AcademicYearSemester;
use App\Models\Course;
use App\Models\CourseTeacher;
use App\Models\Department;
use App\Models\OpenCourseRegisteration;
use App\Models\Teacher;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\DepartmentRegisterationPeriodSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\TeacherSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class OpenCourseForRegisterationTest extends AdminTestCase
{
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
                OpenCourseRegisteration::first()->id,
                Teacher::first()->id,
                1
            );

        $assign_a_teacher_to_an_open_course_route = $this->main_route.'/teachers';

        $response =
            $this
                ->postJson(
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

        $it_deparmtent_id =
            Department::firstWhere('name', 'IT')->id;

        $twenty_sixteent_year_semester_zero_id =
            AcademicYearSemester::where('year', '2016')
                ->where('semester', 0)
                ->first()
                ->id;

        $course_that_has_cross_one_listed_course_id =
            Course::query()
                ->has('firstCrossListedCourses', 1)
                ->orHas('SecondCrossListedCourses', 1)
                ->first()
                ->id;

        $before_course_open_count = OpenCourseRegisteration::count();

        $open_course_registeration_request_data =
            OpenCourseForRegisterationRequestData::from([
                'academic_year_semester_id' => $twenty_sixteent_year_semester_zero_id,
                'department_id' => $it_deparmtent_id,
                'courses_ids' => [$course_that_has_cross_one_listed_course_id],
            ]);

        $response =
            $this
                ->postJson(
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

    #[Test]
    public function delete_an_existing_open_course_with_200_response(): void
    {

        $open_course_registeration = OpenCourseRegisteration::first();

        $show_route = $this->main_route.'/'.$open_course_registeration->id;

        $response = $this->deleteJson($show_route);

        $response->assertStatus(200);

        $open_course = OpenCourseRegisteration::query()
            ->whereId($open_course_registeration->id)
            ->first();

        $this->assertNull($open_course);

    }
}
