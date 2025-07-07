<?php

namespace Tests\Feature\Admin\Department;

use App\Data\Admin\Department\CreateDepartment\Request\CreateDepartmentRequestData;
use App\Data\Admin\Department\UpdateDepartment\Request\UpdateDepartmentRequestData;
use App\Models\Department;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Admin\AdminTest;

class DepartmentTest extends AdminTest
{
    protected string $main_route = '/admins/departments';

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            AcademicYearSemesterSeeder::class,
            DepartmentSeeder::class,
        ]);
    }

    #[Test]
    public function get_departments_with_200_response(): void
    {

        $response =
            $this
                ->getJson(
                    $this->main_route,
                );

        $response->assertStatus(200);

    }

    #[Test]
    public function create_department_with_200_response(): void
    {

        $create_course_department_request =
            new CreateDepartmentRequestData(
                'test'
            );

        $response =
            $this
                ->postJson(
                    $this->main_route,
                    $create_course_department_request->toArray()

                );

        $response->assertStatus(200);

        $department_has_been_created =
            Department::query()
                ->firstWhere(
                    'name',
                    $create_course_department_request->name
                )
                !=
                null;

        $this
            ->assertTrue(
                $department_has_been_created
            );

    }

    #[Test]
    public function update_department_with_200_response(): void
    {

        $first_department =
            Department::query()
                ->first();

        $show_route = $this->main_route.'/'.$first_department->id;

        $update_department_request =
            new UpdateDepartmentRequestData(
                'test department',
                $first_department->id
            )->toArray();

        $response = $this->patch(
            $show_route,
            $update_department_request

        );

        $response->assertStatus(200);

        $updated_department =
            $first_department->fresh();

        $department_has_been_updated =
            $updated_department->name
            !==
            $first_department->name;

        $this
            ->assertTrue(
                $department_has_been_updated
            );

    }

    #[Test]
    public function delete_department_with_200_response(): void
    {

        $first_department =
            Department::query()
                ->first();

        $show_route = $this->main_route.'/?ids[]='.$first_department->id;

        $response = $this->deleteJson($show_route);

        $response->assertStatus(200);

        $deleted_department = Department::query()
            ->whereId($first_department->id)
            ->first();

        $department_has_been_deleted =
         $deleted_department == null;

        $this->assertTrue($department_has_been_deleted);

    }

    #[Test]
    public function get_department_teachers_with_200_response(): void
    {

        $first_department =
            Department::first();

        $department_teacher_routes =
            $this->main_route
            .
            '/'.
            $first_department->id
            .
            '/'
            .
            'teachers';

        $response =
            $this
                ->getJson(
                    $department_teacher_routes
                );

        $response->assertStatus(200);

    }
}
