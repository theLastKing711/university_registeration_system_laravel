<?php

namespace Tests\Feature\Admin\Teacher;

use App\Data\Admin\Teacher\CreateTeacher\Request\CreateTeacherRequestData;
use App\Data\Admin\Teacher\GetTeachersPaginated\Response\GetTeachersPaginatedResponsePaginationResultData;
use App\Data\Admin\Teacher\UpdateTeacher\Request\UpdateTeacherRequestData;
use App\Models\Department;
use App\Models\Teacher;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\TeacherSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class TeacherTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->route_builder
            ->withPaths('teachers');

        $this->
            seed([
                AcademicYearSemesterSeeder::class,
                DepartmentSeeder::class,
                TeacherSeeder::class,
            ]);

    }

    // get_teachers
    #[Test]
    public function get_teachers_with_200_response(): void
    {

        $get_teachers_route =
            $this
                ->route_builder
                ->build();

        $this
            ->assertNotNull(
                $this->route_builder
            );

        $response =
            $this
                ->getJson(
                    $get_teachers_route
                );

        $response->assertStatus(200);

    }

    // get_teachers_paginated
    #[Test]
    public function get_teachers_paginated_with_200_response(): void
    {

        $per_page = 1;

        $get_teachers_paginated_route =
            $this
                ->route_builder
                ->withPaths('paginated')
                ->withQueryParameters([
                    'perPage' => $per_page,
                ])
                ->build();

        $response =
            $this
                ->getJson(
                    $get_teachers_paginated_route
                );

        $response->assertStatus(200);

        $response_data =
            GetTeachersPaginatedResponsePaginationResultData::from($response->json());

        $response_data_has_correct_count =
            $response_data
                ->data
                ->count()
            ==
            $per_page;

        $this
            ->assertTrue(
                $response_data_has_correct_count
            );

    }

    // get_teacher
    #[Test]
    public function get_teacher_with_200_response(): void
    {

        $teacher =
            Teacher::query()
                ->first();

        $get_teacher_route =
            $this
                ->route_builder
                ->withPaths(
                    paths: $teacher->id
                )
                ->build();

        $response =
            $this
                ->getJson(
                    $get_teacher_route,
                );

        $response->assertStatus(200);

    }

    // create_teacher
    #[Test]
    public function create_teacher_with_200_response(): void
    {

        $department_id =
            Department::query()
                ->first()
                ->id;

        $create_teacher_request =
            new CreateTeacherRequestData(
                fake()->name(),
                $department_id
            );

        $create_teacher_route =
            $this->
                route_builder
                    ->build();

        $response =
            $this
                ->postJson(
                    $create_teacher_route,
                    $create_teacher_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_teacher =
                Teacher::query()
                    ->where(
                        'name',
                        $create_teacher_request->name
                    )
                    ->first();

        $teacher_has_been_created =
            $created_teacher != null;

        $this
            ->assertTrue(
                $teacher_has_been_created
            );

    }

    // update_teacher
    #[Test]
    public function update_teacher_with_200_response(): void
    {

        $teacher =
            Teacher::query()
                ->first();

        $department_id =
            Department::query()
                ->first()
                ->id;

        $update_teacher_request =
            new UpdateTeacherRequestData(
                fake()->name,
                $department_id,
                $teacher->id
            );

        $update_teacher_route =
            $this
                ->route_builder
                ->withPaths($teacher->id)
                ->build();

        $response =
            $this
                ->patchJson(
                    $update_teacher_route,
                    $update_teacher_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $updated_teacher =
                Teacher::query()
                    ->where(
                        [
                            'id' => $teacher->id,
                            'name' => $update_teacher_request->name,
                        ]
                    )
                    ->first();

        $teacher_has_been_updated =
            $updated_teacher != null;

        $this
            ->assertTrue(
                $teacher_has_been_updated
            );

    }

    // delete_teacher
    #[Test]
    public function delete_teacher_with_200_response(): void
    {

        $teacher =
            Teacher::query()
                ->first();

        $this->assertNotNull($teacher);

        $delete_teacher_route =
            $this
                ->route_builder
                ->withPaths($teacher->id)
                ->build();

        $response =
            $this
                ->deleteJson(
                    $delete_teacher_route,
                );

        $response->assertStatus(200);

        $deleted_teachers =
                $teacher->fresh();

        $teacher_have_been_deleted =
            $deleted_teachers
            ==
            null;

        $this
            ->assertTrue(
                $teacher_have_been_deleted
            );

    }

    // delete_teachers
    #[Test]
    public function delete_teachers_with_200_response(): void
    {

        $teachers =
            Teacher::query()
                ->take(2)
                ->get();

        $delete_teacher_route =
            $this
                ->route_builder
                ->withArrayQueryParameter(
                    $teachers->pluck('id')
                )
                ->build();

        $response =
            $this
                ->deleteJson(
                    $delete_teacher_route,
                );

        $response->assertStatus(200);

        $deleted_teachers =
                $teachers->fresh();

        $teachers_have_been_deleted =
            $deleted_teachers->isEmpty();

        $this
            ->assertTrue(
                $teachers_have_been_deleted
            );

    }
}
