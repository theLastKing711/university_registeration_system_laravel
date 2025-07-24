<?php

namespace Tests\Feature\Admin\Department;

use App\Data\Admin\Department\CreateDepartment\Request\CreateDepartmentRequestData;
use App\Data\Admin\Department\UpdateDepartment\Request\UpdateDepartmentRequestData;
use App\Models\Department;
use Database\Seeders\AcademicYearSemesterSeeder;
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
        ]);
    }

    #[Test]
    public function get_departments_with_200_response(): void
    {

        Department::factory(2)
            ->create();

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

        $this
            ->assertDatabaseHas(
                Department::class,
                [
                    'name' => $create_course_department_request->name,
                ]
            );

    }

    #[Test]
    public function update_department_with_200_response(): void
    {

        $new_department =
            Department::factory()
                ->create();

        $update_department_request =
            new UpdateDepartmentRequestData(
                'test department',
                $new_department->id
            );

        $response =
            $this
                ->withRoutePaths(
                    $new_department->id
                )
                ->patchJsonData(
                    $update_department_request->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                Department::class,
                [
                    'id' => $new_department->id,
                    'name' => $update_department_request->name,
                ]
            );

    }

    #[Test]
    public function delete_department_with_200_response(): void
    {

        $new_department =
            Department::factory()
                ->create();
        $response =
            $this
                ->withArrayQueryParameter([
                    $new_department->id,
                ])
                ->deleteJsonData();

        $response->assertStatus(200);
        $this
            ->assertDatabaseMissing(
                Department::class,
                [
                    'id' => $new_department->id,
                ]
            );

    }

    #[Test]
    public function get_department_teachers_with_200_response(): void
    {

        $new_department =
            Department::factory()
         ->create();

        $response =
            $this
                ->withRoutePaths(
                    $new_department->id,
                    'teachers'
                )
                ->getJsonData();

        $response->assertStatus(200);

    }
}
