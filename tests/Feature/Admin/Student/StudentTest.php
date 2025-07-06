<?php

namespace Tests\Feature\Admin\Student;

use App\Data\Admin\Student\GraduateStudent\Request\GraduateStudentRequestData;
use App\Data\Admin\Student\RegisterStudent\Request\RegisterStudentRequestData;
use App\Data\Admin\Student\UpdateStudent\Request\UpdateStudentRequestData;
use App\Enum\Auth\RolesEnum;
use App\Models\Department;
use App\Models\User;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\StudentSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class StudentTest extends AdminTestCase
{
    private string $main_route = '/admins/students';

    protected function setUp(): void
    {
        parent::setUp();

        $this->
            seed([
                AcademicYearSemesterSeeder::class,
                DepartmentSeeder::class,
                StudentSeeder::class,
            ]);

    }

    #[Test]
    public function register_student_with_201_response(): void
    {

        $department_id =
            Department::query()
                ->first()
                ->id;

        $register_student_request =
            new RegisterStudentRequestData(
                $department_id,
                fake()->randomNumber(6, true),
                '1998-01-01',
                '214-01-10',
                fake()->phoneNumber(),
                fake()->name(),
                fake()->password(),
            );

        $register_student_route =
            $this->main_route;

        $response =
            $this
                ->postJson(
                    $register_student_route,
                    $register_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_student =
                User::query()
                    ->where(
                        'name',
                        $register_student_request->name
                    )
                    ->first();

        $student_has_been_created =
            $created_student != null;

        $this
            ->assertTrue(
                $student_has_been_created
            );

        $created_student_has_student_role =
            $created_student->hasRole(RolesEnum::STUDENT);

        $this
            ->assertTrue(
                $created_student_has_student_role
            );

    }

    #[Test]
    public function update_student_with_201_response(): void
    {

        $student =
            User::query()
                ->whereRelation(
                    'roles',
                    'name',
                    RolesEnum::STUDENT->value
                )
                ->first();

        $department_id =
            Department::query()
                ->first()
                ->id;

        $update_student_request =
            new UpdateStudentRequestData(
                $department_id,
                fake()->randomNumber(6, true),
                '1998-01-01',
                '214-01-10',
                '214-01-10',
                fake()->phoneNumber(),
                fake()->name(),
                fake()->password(),
                $student->id
            );

        $update_student_route =
            $this->main_route
            .
            '/'
            .
            $student->id;

        $response =
            $this
                ->patchJson(
                    $update_student_route,
                    $update_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $updated_student =
                User::query()
                    ->where(
                        [
                            'id' => $student->id,
                            'department_id' => $update_student_request->department_id,
                            'national_id' => $update_student_request->national_id,
                            'birthdate' => $update_student_request->birthdate,
                            'enrollment_date' => $update_student_request->enrollment_date,
                            'graduation_date' => $update_student_request->graduation_date,
                            'phone_number' => $update_student_request->phone_number,
                            'name' => $update_student_request->name,
                        ]
                    )
                    ->first();

        $student_has_been_updated =
            $updated_student != null;

        $this
            ->assertTrue(
                $student_has_been_updated
            );

    }

    #[Test]
    public function delete_student_with_201_response(): void
    {

        $student =
            User::query()
                ->whereRelation(
                    'roles',
                    'name',
                    RolesEnum::STUDENT->value
                )
                ->first();

        $delete_student_route =
            $this->main_route
            .
            '/'
            .
            $student->id;

        $response =
            $this
                ->deleteJson(
                    $delete_student_route,
                );

        $response->assertStatus(200);

        $deleted_student =
                $student->fresh();

        $student_has_been_deleted =
            $deleted_student == null;

        $this
            ->assertTrue(
                $student_has_been_deleted
            );

    }

    #[Test]
    public function graduate_student_with_201_response(): void
    {

        $student =
            User::query()
                ->first();

        $graduate_student_request =
            new GraduateStudentRequestData(
                '2018-01-1'
            );

        $graduate_student_route =
            $this->main_route
            .
            '/'
            .
            $student->id
            .
            '/'
            .
            'graduation';

        $response =
            $this
                ->patchJson(
                    $graduate_student_route,
                    $graduate_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $graduated_student =
                User::query()
                    ->where(
                        [
                            'id' => $student->id,
                            'graduation_date' => $graduate_student_request->graduation_date,
                        ]
                    )
                    ->first();

        $student_has_been_graduated =
            $graduated_student != null;

        $this
            ->assertTrue(
                $student_has_been_graduated
            );

    }
}
