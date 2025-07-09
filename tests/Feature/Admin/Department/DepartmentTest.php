<?php

namespace Tests\Feature\Admin\Department;

use App\Data\Admin\Department\CreateDepartment\Request\CreateDepartmentRequestData;
use App\Data\Admin\Department\UpdateDepartment\Request\UpdateDepartmentRequestData;
use App\Models\Department;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class DepartmentTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->route_builder
            ->withPaths('departments');

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
                ->getJsonData();

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
                ->postJsonData(
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
                condition: $department_has_been_created
            );

    }

    #[Test]
    public function update_department_with_200_response(): void
    {

        $first_department =
            Department::query()
                ->first();

        $update_department_request =
            new UpdateDepartmentRequestData(
                'test department',
                $first_department->id
            )->toArray();

        $response =
            $this
                ->withRoutePaths(
                    $first_department->id
                )
                ->patchJsonData(
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

        $response =
            $this
                ->withArrayQueryParameter([
                    $first_department->id,
                ])
                ->deleteJsonData();

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

        $response =
            $this
                ->withRoutePaths(
                    $first_department->id,
                    'teachers'
                )
                ->getJsonData();

        $response->assertStatus(200);

    }
}
