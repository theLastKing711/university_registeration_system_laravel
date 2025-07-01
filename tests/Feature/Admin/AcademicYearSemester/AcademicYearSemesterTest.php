<?php

namespace Tests\Feature\Admin\AcademicYearSemester;

use App\Data\Admin\AcademicYearSemester\CreateAcademicYearSemester\Request\CreateAcademicYearSemesterRequestData;
use App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Response\GetAcademicYearsSemestersResponsePaginationResultData;
use App\Data\Admin\AcademicYearSemester\OpenDepartmentsForRegisteration\Request\OpenDepartmentsForRegisterationRequestData;
use App\Data\Admin\AcademicYearSemester\UpdateAcademicYearSemester\Request\UpdateAcademicYearSemesterRequestData;
use App\Models\AcademicYearSemester;
use App\Models\Department;
use App\Models\DepartmentRegisterationPeriod;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentRegisterationPeriodSeeder;
use Database\Seeders\DepartmentSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class AcademicYearSemesterTest extends AdminTestCase
{
    private string $main_route = '/admins/academic-year-semesters';

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            AcademicYearSemesterSeeder::class,
            DepartmentSeeder::class,
            DepartmentRegisterationPeriodSeeder::class,
        ]);

    }

    #[Test]
    public function get_academic_years_semesters_with_201_response(): void
    {

        $first_department =
            Department::first();

        $get_academic_years_semesters_route =
            $this
                ->main_route
                .
                '?department_id='
                .
                $first_department->id
                .
                '&year=2014'
                .
                '&semester=0';

        $response =
            $this
                ->getJson(
                    $get_academic_years_semesters_route,
                );

        $response->assertStatus(200);

        $pagination_response_data =
            GetAcademicYearsSemestersResponsePaginationResultData::from(
                $response
                    ->json()
            );

        $repsonse_has_data =
            $pagination_response_data
                ->data
                ->isNotEmpty();

        $this
            ->assertTrue(
                $repsonse_has_data,
            );

    }

    #[Test]
    public function create_academic_year_semester_with_201_response(): void
    {

        $create_academic_year_semester_request =
            new CreateAcademicYearSemesterRequestData(
                2017,
                0
            );

        $response =
            $this
                ->postJson(
                    $this->main_route,
                    $create_academic_year_semester_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_academic_year_semester =
            AcademicYearSemester::query()
                ->where(
                    'year',
                    $create_academic_year_semester_request->year
                )
                ->where(
                    'semester',
                    $create_academic_year_semester_request->semester
                )
                ->first();

        $this->assertNotNull($created_academic_year_semester);

    }

    #[Test]
    public function delete_academic_year_semester_with_201_response(): void
    {

        $first_academic_year_semester =
            AcademicYearSemester::query()
                ->first();

        $show_route =
            $this->main_route
            .
            '/'
            .
            $first_academic_year_semester
                ->id;

        $response =
            $this
                ->deleteJson(
                    $show_route

                );

        $response
            ->assertStatus(
                200
            );

        $created_academic_year_semester =
            AcademicYearSemester::query()
                ->where(
                    'id',
                    $first_academic_year_semester
                        ->id
                )
                ->first();

        $this
            ->assertNull(
                $created_academic_year_semester
            );

    }

    #[Test]
    public function update_academic_year_semester_with_201_response(): void
    {

        $update_academic_year_semester_request =
            new UpdateAcademicYearSemesterRequestData(
                2018,
                0,
                AcademicYearSemester::first()->id
            );

        $first_academic_year_semester =
            AcademicYearSemester::query()
                ->firstWhere(
                    'id',
                    $update_academic_year_semester_request->id
                );

        $show_route =
            $this->main_route
            .
            '/'
            .
            $first_academic_year_semester
                ->id;

        $response =
            $this
                ->patchJson(
                    $show_route,
                    $update_academic_year_semester_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $updated_academic_year_semester =
                $first_academic_year_semester
                    ->fresh();

        $this
            ->assertEquals(
                $update_academic_year_semester_request->year,
                $updated_academic_year_semester->year
            );

        $this
            ->assertEquals(
                $update_academic_year_semester_request->semester,
                $updated_academic_year_semester->semester
            );

    }

    #[Test]
    public function open_department_for_registeration_with_201_response(): void
    {

        $academic_year_semester =
            AcademicYearSemester::query()
                ->where(
                    'year',
                    2016
                )
                ->where(
                    'semester',
                    1
                )
                ->first();

        $first_two_departments_ids =
            Department::all()->pluck('id')->take(2)->toArray();

        $open_department_for_registeration_request =
            new OpenDepartmentsForRegisterationRequestData(
                $first_two_departments_ids,
                $academic_year_semester->id
            );

        $open_department_for_registeration_route =
            $this->main_route.'/'.$academic_year_semester->id.'/departments';

        $response =
            $this
                ->postJson(
                    $open_department_for_registeration_route,
                    $open_department_for_registeration_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $created_department_registeration_periods =
            DepartmentRegisterationPeriod::query()
                ->whereIn(
                    'department_id',
                    $open_department_for_registeration_request->departments_ids
                )
                ->where(
                    'academic_year_semester_id',
                    $open_department_for_registeration_request->id
                )
                ->get();

        $departments_has_opened_for_registeration =
            $created_department_registeration_periods
                ->count() == 2;

        $this
            ->assertTrue(
                $departments_has_opened_for_registeration
            );

    }
}
