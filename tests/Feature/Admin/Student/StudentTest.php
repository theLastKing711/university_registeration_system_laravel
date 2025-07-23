<?php

namespace Tests\Feature\Admin\Student;

use App\Data\Admin\Student\GraduateStudent\Request\GraduateStudentRequestData;
use App\Data\Admin\Student\RegisterStudent\Request\RegisterStudentRequestData;
use App\Data\Admin\Student\UpdateStudent\Request\UpdateStudentRequestData;
use App\Models\Department;
use App\Models\User;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class StudentTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths(
                'students'
            );

        $this->
            seed([
                AcademicYearSemesterSeeder::class,
                DepartmentSeeder::class,
            ]);

    }

    #[Test]
    public function register_student_with_200_response(): void
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

        $response =
            $this
                ->postJsonData(
                    $register_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                User::class,
                [
                    'department_id' => $register_student_request->department_id,
                    'national_id' => $register_student_request->national_id,
                    'birthDate' => $register_student_request->birthdate,
                    'enrollment_date' => $register_student_request->enrollment_date,
                    'phone_number' => $register_student_request->phone_number,
                    'name' => $register_student_request->name,
                ]
            );

    }

    #[Test]
    public function update_student_with_200_response(): void
    {

        /** @var User $new_students */
        $new_student =
            User::factory()
                ->withStudentRole()
                ->create();

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
                $new_student->id
            );

        $response =
            $this
                ->withRoutePaths(
                    $new_student->id
                )
                ->patchJsonData(
                    $update_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                User::class,
                [
                    'id' => $new_student->id,
                    'department_id' => $update_student_request->department_id,
                    'national_id' => $update_student_request->national_id,
                    'birthDate' => $update_student_request->birthdate,
                    'enrollment_date' => $update_student_request->enrollment_date,
                    'phone_number' => $update_student_request->phone_number,
                    'name' => $update_student_request->name,
                ]
            );

    }

    #[Test]
    public function delete_student_with_200_response(): void
    {

        $new_student =
             User::factory()
                 ->withStudentRole()
                 ->create();

        $response =
            $this
                ->withRoutePaths(
                    $new_student->id
                )
                ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                User::class,
                [
                    'id' => $new_student->id,
                ]
            );

    }

    #[Test]
    public function graduate_student_with_200_response(): void
    {

        $new_student =
             User::factory()
                 ->withStudentRole()
                 ->create();

        $graduate_student_request =
            new GraduateStudentRequestData(
                '2018-01-1'
            );

        $response =
            $this
                ->withRoutePaths(
                    $new_student->id,
                    'graduation'
                )
                ->patchJsonData(
                    $graduate_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                User::class,
                [
                    'id' => $new_student->id,
                    'graduation_date' => $graduate_student_request->graduation_date,
                ]
            );

    }
}
