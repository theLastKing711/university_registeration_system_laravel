<?php

namespace Tests\Feature\Admin\Teacher;

use App\Data\Admin\Teacher\CreateTeacher\Request\CreateTeacherRequestData;
use App\Data\Admin\Teacher\GetTeachersPaginated\Response\GetTeachersPaginatedResponsePaginationResultData;
use App\Data\Admin\Teacher\UpdateTeacher\Request\UpdateTeacherRequestData;
use App\Models\Department;
use App\Models\Teacher;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class TeacherTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths(
                'teachers'
            );

        $this->
            seed([
                AcademicYearSemesterSeeder::class,
                DepartmentSeeder::class,
            ]);

    }

    // get_teachers
    #[Test]
    public function get_teachers_with_200_response(): void
    {

        Teacher::factory(5)
            ->create();

        $response =
            $this
                ->getJsonData();

        $response->assertStatus(200);

    }

    // get_teachers_paginated
    #[Test]
    public function get_teachers_paginated_with_200_response(): void
    {

        Teacher::factory(5)
            ->create();

        $per_page = 1;

        $response =
            $this
                ->withRoutePaths('paginated')
                ->withQueryParameters([
                    'perPage' => $per_page,
                ])
                ->getJsonData();

        $response->assertStatus(200);

        $response_data =
            GetTeachersPaginatedResponsePaginationResultData::from($response->json());

        $this->assertEquals(
            $per_page,
            $response_data
                ->data
                ->count()
        );

    }

    // get_teacher
    #[Test]
    public function get_teacher_with_200_response(): void
    {

        $new_teacher =
             Teacher::factory()
                 ->create();

        $response =
            $this
                ->withRoutePaths(
                    $new_teacher->id
                )
                ->getJsonData();

        $response->assertStatus(200);

    }

    // create_teacher
    #[Test]
    public function create_teacher_with_200_response(): void
    {

        $create_teacher_request =
            new CreateTeacherRequestData(
                fake()->name(),
                Department::value('id')
            );

        $response =
            $this
                ->postJsonData(
                    $create_teacher_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                Teacher::class,
                [
                    'name' => $create_teacher_request->name,
                    'department_id' => $create_teacher_request->department_id,
                ]
            );

    }

    // update_teacher
    #[Test]
    public function update_teacher_with_200_response(): void
    {

        $new_teacher =
           Teacher::factory()
               ->create();

        $update_teacher_request =
            new UpdateTeacherRequestData(
                fake()->name,
                $new_teacher->department_id,
                $new_teacher->id
            );

        $response =
            $this
                ->withRoutePaths($new_teacher->id)
                ->patchJsonData(
                    $update_teacher_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                Teacher::class,
                [
                    'id' => $new_teacher->id,
                    'name' => $update_teacher_request->name,
                    'department_id' => $update_teacher_request->department_id,
                ]
            );

    }

    // delete_teacher
    #[Test]
    public function delete_teacher_with_200_response(): void
    {

        $new_teacher =
          Teacher::factory()
              ->create();

        $response =
            $this
                ->withRoutePaths($new_teacher->id)
                ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                Teacher::class,
                [
                    'id' => $new_teacher->id,
                ]
            );

    }

    // delete_teachers
    #[Test]
    public function delete_teachers_with_200_response(): void
    {

        /** @var Collection<Teacher> $new_teachers */
        $new_teachers =
            Teacher::factory(2)
                ->create();

        $response =
            $this
                ->withArrayQueryParameter(
                    $new_teachers->pluck('id')
                )
                ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseCount(
                Teacher::class,
                0
            );

    }
}
