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
use Database\Seeders\CourseTeacherSeeder;
use Database\Seeders\DepartmentRegisterationPeriodSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\TeacherSeeder;
use Illuminate\Database\Eloquent\Builder;
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
            CourseTeacherSeeder::class,
        ]);

    }

    // assign_a_teacher_to_an_open_course
    #[Test]
    public function assign_a_teacher_to_an_open_course_with_200_response(): void
    {

        CourseTeacher::query()
            ->delete();

        $open_course_id =
            OpenCourseRegisteration::first()->id;

        $assign_a_teacher_to_an_open_course =
            new AssignTeacherToCourseRequestData(
                OpenCourseRegisteration::first()->id,
                Teacher::first()->id,
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

    }

    // un_assign_a_teacher_from_an_open_course
    #[Test]
    public function un_assign_a_teacher_from_an_open_course_with_200_response(): void
    {
        $open_course_id =
            OpenCourseRegisteration::query()
                ->with('teachers')
                ->first();

        $response =
            $this
                ->withRoutePaths(
                    $open_course_id->id,
                    'teachers',
                )
                ->withArrayQueryParameter(
                    $open_course_id->teachers->pluck('id'),
                    array_query_parameter_name: 'teachers_ids'
                )
                ->deleteJsonData();

        $response->assertStatus(200);

        $course_teacher_has_been_deleted =
                $open_course_id
                    ->fresh()
                    ->teachers->isEmpty();

        $this
            ->assertTrue(
                $course_teacher_has_been_deleted
            );

    }

    #[Test]
    public function assign_a_teacher_to_an_open_course_fails_only_one_main_teacher_per_course_validation_with_422_response(): void
    {

        $open_course_id =
            OpenCourseRegisteration::query()
                ->whereRelation(
                    'courseTeachers',
                    'is_main_teacher',
                    true
                )
                ->first()
                ->id;

        $assign_a_teacher_to_an_open_course =
            new AssignTeacherToCourseRequestData(
                OpenCourseRegisteration::first()->id,
                Teacher::first()->id,
                $open_course_id
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

        $it_deparmtent_id =
            Department::query()
                ->firstWhere('name', 'IT')
                ->id;

        $twenty_sixteent_year_semester_zero_id =
            AcademicYearSemester::where('year', '2014')
                ->where('semester', operator: 0)
                ->first()
                ->id;

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
                'courses_ids' => [$course_that_has_cross_one_listed_course->id],
            ]);

        $response =
            $this
                ->postJsonData(
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

    // delete_an_existing_open_course
    #[Test]
    public function delete_an_existing_open_course_with_200_response(): void
    {

        $open_course_registeration = OpenCourseRegisteration::first();

        $response =
             $this
                 ->withRoutePaths(
                     $open_course_registeration->id
                 )
                 ->deleteJsonData();

        $response->assertStatus(200);

        $open_course = OpenCourseRegisteration::query()
            ->whereId($open_course_registeration->id)
            ->first();

        $this->assertNull($open_course);

    }
}
