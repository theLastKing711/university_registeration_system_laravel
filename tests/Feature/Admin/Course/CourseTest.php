<?php

namespace Tests\Feature\Admin\Course;

use App\Data\Admin\Course\CreateCourse\Request\CreateCourseRequestData;
use App\Data\Admin\Course\GetCourse\Response\GetCourseResponseData;
use App\Data\Admin\Course\GetCourses\Response\GetCoursesResponseData;
use App\Data\Admin\Course\GetCourses\Response\GetCoursesResponsePaginationResultData;
use App\Data\Admin\Course\UpdateCourse\Request\Admin\Course\UpdateCourseRequestData;
use App\Models\Course;
use App\Models\Department;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\DepartmentSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class CourseTest extends AdminTestCase
{
    private string $main_route = '/admins/courses';

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            AcademicYearSemesterSeeder::class,
            DepartmentSeeder::class,
            CourseSeeder::class,
        ]);

    }

    #[Test]
    public function get_courses_with_200_response(): void
    {

        $it_department_id =
            Department::query()
                ->firstWhere(
                    'name',
                    'IT'
                )
                ->id;

        $courses_route =
            $this->main_route
            .
            '?department_id='
            .
            $it_department_id;

        $response =
            $this
                ->getJson(
                    $courses_route,
                );

        $response->assertStatus(200);

        $resposne_data =
                GetCoursesResponsePaginationResultData::from($response->json());

        $response_has_data =
            $resposne_data
                ->data
                ->isNotEmpty();

        $this
            ->assertTrue(
                $response_has_data
            );

        $resposne_has_courses_only_from_it_department = $resposne_data
            ->data
            ->every(
                fn (GetCoursesResponseData $course) => $course->department_id
                    ==
                    $it_department_id
            );

        $this
            ->assertTrue(
                $resposne_has_courses_only_from_it_department
            );

    }

    #[Test]
    public function get_course_with_200_response(): void
    {

        $request_course_id =
            Course::query()
                ->has('firstCrossListed')
                ->first()
                ->id;

        $course_route =
            $this->main_route
            .
            '/'
            .
            $request_course_id;

        $response =
            $this
                ->getJson(
                    $course_route,
                );

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

        $it_department_id =
            Department::query()
                ->firstWhere(
                    'name',
                    'IT'
                )
                ->id;

        $create_course_request =
            new CreateCourseRequestData(
                $it_department_id,
                'testing',
                'TEST',
                true,
                3,
                1
            );

        $course_route = $this->main_route;

        $response =
            $this
                ->postJson(
                    $course_route,
                    $create_course_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_course =
                Course::query()
                    ->where(
                        'name',
                        $create_course_request->name
                    )
                    ->first();

        $course_has_been_created =
            $created_course != null;

        $this
            ->assertTrue(
                $course_has_been_created
            );

    }

    #[Test]
    public function update_course_with_200_response(): void
    {

        $it_department_id =
            Department::query()
                ->firstWhere(
                    'name',
                    'IT'
                )
                ->id;

        /** @var Course $random_course_id_to_update */
        $random_course_id_to_update =
            Course::query()
                ->with(
                    'prerequisites',
                    'firstCrossListed',
                    'secondCrossListed'
                )
                ->where(
                    'department_id',
                    $it_department_id
                )
                ->first();

        $two_random_prerequisties_ids =
            Course::query()
                ->where(
                    'id',
                    '!=',
                    $random_course_id_to_update->id
                )
                ->take(2)
                ->get()
                ->pluck('id')
                ->toArray();

        $two_random_courses_to_cross_list_ids =
           Course::query()
               ->where(
                   'id',
                   '!=',
                   $random_course_id_to_update->id
               )
               ->whereNotIn('id', $two_random_prerequisties_ids)
               ->take(2)
               ->get()
               ->pluck('id')
               ->toArray();

        $update_course_request =
            new UpdateCourseRequestData(
                $it_department_id,
                'testing',
                'TEST',
                true,
                3,
                1,
                $two_random_courses_to_cross_list_ids,
                $two_random_prerequisties_ids,
                $random_course_id_to_update->id
            );

        $update_course_route =
            $this->main_route.'/'.$update_course_request->id;

        $response =
            $this
                ->patchJson(
                    $update_course_route,
                    $update_course_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $random_course_id_to_update
            ->refresh();

        $this
            ->assertTrue(
                $random_course_id_to_update
                    ->prerequisites
                    ->count()
                            ==
                            2
            );

        $this
            ->assertTrue(
                $random_course_id_to_update
                    ->secondCrossListed
                    ->count()
                            ==
                            0
            );

        $this
            ->assertTrue(
                $random_course_id_to_update
                    ->firstCrossListed
                    ->count()
                            ==
                            2
            );

        // $updated_course =
        //         Course::query()
        //             ->firstWhere(
        //                 'id',
        //                 $update_course_request->id
        //             );

    }

    #[Test]
    public function delete_course_with_200_response(): void
    {

        $first_course =
            Course::query()
                ->first();

        $show_route = $this->main_route.'/?ids[]='.$first_course->id;

        $response = $this->deleteJson($show_route);

        $response->assertStatus(200);

        $deleted_course = Course::query()
            ->whereId($first_course->id)
            ->first();

        $course_has_been_deleted =
         $deleted_course == null;

        $this->assertTrue($course_has_been_deleted);

    }
}
