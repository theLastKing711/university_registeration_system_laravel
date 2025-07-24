<?php

namespace Tests\Feature\Admin\Course;

use App\Data\Admin\Course\CreateCourse\Request\CreateCourseRequestData;
use App\Data\Admin\Course\GetCourse\Response\GetCourseResponseData;
use App\Data\Admin\Course\GetCourses\Response\GetCoursesResponseData;
use App\Data\Admin\Course\GetCourses\Response\GetCoursesResponsePaginationResultData;
use App\Data\Admin\Course\UpdateCourse\Request\Admin\Course\UpdateCourseRequestData;
use App\Models\Course;
use App\Models\CrossListedCourses;
use App\Models\Department;
use App\Models\Prerequisite;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class CourseTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths(
                'courses'
            );

        $this->seed([
            AcademicYearSemesterSeeder::class,
            DepartmentSeeder::class,
        ]);

    }

    #[Test]
    public function get_courses_with_200_response(): void
    {

        /** @var Collection<Course> $new_courses */
        $new_courses =
            Course::factory(5)
                ->create();

        $department =
            $new_courses->first();

        $response =
            $this
                ->withQueryParameters([
                    'department_id' => $department->id,
                ])
                ->getJsonData();

        $response->assertStatus(200);

        $resposne_data =
                GetCoursesResponsePaginationResultData::from($response->json());

        $this
            ->assertNotEmpty(
                $resposne_data
                    ->data
            );

        $resposne_has_courses_only_from_its_department = $resposne_data
            ->data
            ->every(
                fn (GetCoursesResponseData $course) => $course->department_id
                    ==
                    $department->id
            );

        $this
            ->assertTrue(
                $resposne_has_courses_only_from_its_department
            );

    }

    #[Test]
    public function get_course_with_200_response(): void
    {

        $courses =
            Course::factory()
                ->count(2)
                ->create();

        $main_course =
            $courses->first();

        /** @var Course $cross_listed_course */
        $cross_listed_course =
            $courses
                ->skip(1)
                ->take(1)
                ->first();

        $main_course
            ->firstCrossListed()
            ->attach([$cross_listed_course]);

        $response =
            $this
                ->withRoutePaths(
                    $main_course->id
                )
                ->getJsonData();

        $response->assertStatus(200);

        $resposne_data =
                GetCourseResponseData::from($response->json());

        $response_has_data =
            $resposne_data
                !=
                null;

        $this
            ->assertTrue(
                $response_has_data
            );

    }

    #[Test]
    public function create_course_with_200_response(): void
    {

        $new_course =
            Course::factory()
                ->create();

        $create_course_request =
            new CreateCourseRequestData(
                $new_course->department_id,
                $new_course->name,
                $new_course->code,
                $new_course->is_active,
                $new_course->credits,
                $new_course->open_for_students_in_year
            );

        $response =
            $this
                ->postJsonData(
                    $create_course_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                Course::class,
                [
                    'id' => $new_course->id,
                    'department_id' => $new_course->department_id,
                    'name' => $new_course->name,
                    'code' => $new_course->code,
                    'is_active' => $new_course->is_active,
                    'credits' => $new_course->credits,
                    'open_for_students_in_year' => $new_course->open_for_students_in_year,
                ]
            );

    }

    #[Test]
    public function update_course_with_200_response(): void
    {

        /** @var Course $new_course */
        $new_course =
            Course::factory()
                ->has(
                    Course::factory()->count(2),
                    'firstCrossListed'
                )
                ->has(
                    Course::factory()->count(2),
                    'coursesPrerequisites'
                )
                ->create();

        $prerequiestes_count = 3;

        $cross_listed_count = 1;

        $update_course_request =
            new UpdateCourseRequestData(
                Department::inRandomOrder()->first()->id,
                'TEST COURSE',
                'CED200',
                true,
                2,
                3,
                Course::factory($cross_listed_count)->create()->pluck('id')->toArray(),
                Course::factory($prerequiestes_count)->create()->pluck('id')->toArray(),
                $new_course->id
            );

        $response =
            $this
                ->withRoutePaths(
                    $update_course_request->id
                )
                ->patchJsonData(
                    $update_course_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $new_course
            ->refresh();

        $this
            ->assertTrue(
                $new_course
                    ->prerequisites
                    ->count()
                            ==
                            $prerequiestes_count
            );

        $this
            ->assertTrue(
                $new_course
                    ->secondCrossListed
                    ->count()
                            ==
                            0
            );

        $this
            ->assertTrue(
                $new_course
                    ->firstCrossListed
                    ->count()
                            ==
                            $cross_listed_count
            );

        $this
            ->assertDatabaseHas(
                Course::class,
                [
                    'id' => $new_course->id,
                    'department_id' => $new_course->department_id,
                    'name' => $new_course->name,
                    'code' => $new_course->code,
                    'is_active' => $new_course->is_active,
                    'credits' => $new_course->credits,
                    'open_for_students_in_year' => $new_course->open_for_students_in_year,
                ]
            );

        foreach ($update_course_request->prerequisites_ids as $key => $prerequisite_id) {
            $this->assertDatabaseHas(
                Prerequisite::class,
                [
                    'course_id' => $update_course_request->id,
                    'prerequisite_id' => $prerequisite_id,
                ]
            );
        }

        foreach ($update_course_request->cross_listed_courses_ids as $key => $cross_listed_course_id) {
            $this->assertDatabaseHas(
                CrossListedCourses::class,
                [
                    'first_course_id' => $update_course_request->id,
                    'second_course_id' => $cross_listed_course_id,
                ]
            );
        }

    }

    #[Test]
    public function delete_course_with_200_response(): void
    {

        $new_course =
            Course::factory()
                ->create();

        $response =
            $this
                ->withArrayQueryParameter([
                    $new_course->id,
                ])
                ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                Course::class,
                [
                    'id' => $new_course->id,
                ]
            );

    }
}
