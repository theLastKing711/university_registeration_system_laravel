<?php

namespace Tests\Feature\Admin\Teacher;

use App\Data\Admin\Teacher\CreateTeacher\Request\CreateTeacherRequestData;
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
    private string $main_route = '/admins/teachers';

    protected function setUp(): void
    {
        parent::setUp();

        $this->
            seed([
                AcademicYearSemesterSeeder::class,
                DepartmentSeeder::class,
                TeacherSeeder::class,
            ]);

    }

    #[Test]
    public function create_teacher_with_201_response(): void
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
            $this->main_route;

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

    #[Test]
    public function update_teacher_with_201_response(): void
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
            $this->main_route
            .
            '/'
            .
            $teacher->id;

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

    #[Test]
    public function delete_teachers_with_201_response(): void
    {

        $teachers =
            Teacher::query()
                ->take(2)
                ->get();

        $this
            ->assertNotEmpty(
                $teachers,
            );

        $delete_teacher_route =
            $this->main_route
            .
            $this
                ->genereateQueryParameters(
                    $teachers->pluck('id')
                );

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
