<?php

namespace Tests\Feature\Student\Abstractions;

use App\Helpers\RotueBuilder\RouteBuilder;
use App\Models\User;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\DepartmentRegisterationPeriodSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\UsdCurrencyExchangeRateSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTestCase extends TestCase
{
    use RefreshDatabase;

    public User $student;

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->route_builder =
                RouteBuilder::withMainRoute('students');

        $this->seed(
            [
                UsdCurrencyExchangeRateSeeder::class,
                ClassroomSeeder::class,
                // AcademicYearSemesterSeeder::class,
                RolesAndPermissionsSeeder::class,
                // DepartmentSeeder::class,
                // TeacherSeeder::class,
                // CourseSeeder::class,
                // OpenCourseRegisterationSeeder::class,
                // StudentSeeder::class,
                // DepartmentRegisterationPeriodSeeder::class,
            ]
        );

        // $this->createStudent();

        // $this->actingAs($this->student);
    }

    // private function createStudent(): void
    // {
    //     $this->student =
    //         User::query()
    //             ->has(relation: 'courses', operator: '>', count: 1)
    //             ->has('studentCourseRegisterations')
    //             ->first();
    // }
}
