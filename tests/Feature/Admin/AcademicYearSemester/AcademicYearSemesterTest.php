<?php

namespace Tests\Feature\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\CreateAcademicYearSemester\Request\CreateAcademicYearSemesterRequestData;
use App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Response\GetAcademicYearsSemestersResponsePaginationResultData;
use App\Data\Admin\AcademicYearSemester\OpenDepartmentsForRegisteration\Request\OpenDepartmentsForRegisterationRequestData;
use App\Data\Admin\AcademicYearSemester\UpdateAcademicYearSemester\Request\UpdateAcademicYearSemesterRequestData;
use App\Models\AcademicYearSemester;
use App\Models\Department;
use App\Models\DepartmentRegisterationPeriod;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class AcademicYearSemesterTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths(
                'academic-year-semesters'
            );
    }

    #[Test]
    public function get_academic_years_semesters_with_200_response(): void
    {

        $department =
            Department::first();

        $response =
            $this
                ->withQueryParameters([
                    'department_ids' => $department->id,
                    'year' => 2014,
                    'semester' => 0,
                ])
                ->getJsonData();

        $response->assertStatus(200);

        $pagination_response_data =
            GetAcademicYearsSemestersResponsePaginationResultData::from(
                $response
                    ->json()
            );

        $this
            ->assertNotEmpty(
                $pagination_response_data
                    ->data
            );

    }

    #[Test]
    public function create_academic_year_semester_with_200_response(): void
    {

        $create_academic_year_semester_request =
            new CreateAcademicYearSemesterRequestData(
                2017,
                0
            );

        $response =
            $this
                ->postJsonData(
                    $create_academic_year_semester_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                AcademicYearSemester::class,
                [
                    'year' => $create_academic_year_semester_request->year,
                    'semester' => $create_academic_year_semester_request->semester,
                ]
            );

    }

    #[Test]
    public function delete_academic_year_semester_with_200_response(): void
    {

        $new_academic_year_semester =
            AcademicYearSemester::factory()
                ->create();

        $response =
            $this
                ->withRoutePaths(
                    $new_academic_year_semester->id
                )
                ->deleteJsonData();

        $response
            ->assertStatus(
                200
            );

        $this
            ->assertDatabaseMissing(
                AcademicYearSemester::class,
                [
                    'semester' => $new_academic_year_semester->semester,
                    'year' => $new_academic_year_semester->year,
                ]
            );

    }

    #[Test]
    public function update_academic_year_semester_with_200_response(): void
    {

        $new_academic_year_semester =
            AcademicYearSemester::factory()
                ->create();

        $update_academic_year_semester_request =
            new UpdateAcademicYearSemesterRequestData(
                2018,
                0,
                AcademicYearSemester::first()->id
            );

        $new_academic_year_semester =
            AcademicYearSemester::query()
                ->firstWhere(
                    'id',
                    $update_academic_year_semester_request->id
                );

        $response =
            $this
                ->withRoutePaths(
                    $new_academic_year_semester
                        ->id
                )
                ->patchJsonData(
                    $update_academic_year_semester_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                AcademicYearSemester::class,
                [
                    'id' => $new_academic_year_semester->id,
                    'semester' => $update_academic_year_semester_request->semester,
                    'year' => $update_academic_year_semester_request->year,
                ]
            );

    }

    #[Test]
    public function open_department_for_registeration_with_200_response(): void
    {

        $new_academic_year_semester =
            AcademicYearSemester::factory()
                ->create();

        $two_department_ids =
            Department::factory(2)
                ->create()
                ->pluck('id');

        $open_department_for_registeration_request =
            new OpenDepartmentsForRegisterationRequestData(
                $two_department_ids->toArray(),
                $new_academic_year_semester->id
            );

        $response =
            $this
                ->withRoutePaths(
                    $new_academic_year_semester->id,
                    'departments'
                )
                ->postJsonData(
                    $open_department_for_registeration_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseCount(
                DepartmentRegisterationPeriod::class,
                $two_department_ids->count()
            );

    }
}
