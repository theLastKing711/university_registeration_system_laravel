<?php

namespace Database\Seeders;

use App\Models\AcademicYearSemester;
use DB;
use Illuminate\Database\Seeder;

class DepartmentRegisterationPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $acadimic_year_semesters =
            AcademicYearSemester::all();

        DB::table(
            'department_registeration_periods'
        )
            ->insert([
                [
                    'id' => 1,
                    'department_id' => 1,
                    'academic_year_semester_id' => $acadimic_year_semesters
                        ->where('year', '2014')
                        ->where('semester', 0)
                        ->first()
                        ->id,

                    'is_open_for_students' => false,
                ],
                [
                    'id' => 2,
                    'department_id' => 1,
                    $acadimic_year_semesters
                        ->where('year', '2014')
                        ->where('semester', 1)
                        ->first()
                        ->id,
                    'is_open_for_students' => false,
                ],
                [
                    'id' => 3,
                    'department_id' => 1,
                    $acadimic_year_semesters
                        ->where('year', '2014')
                        ->where('semester', 2)
                        ->first()
                        ->id,
                    'is_open_for_students' => false,
                ],
                [
                    'id' => 4,
                    'department_id' => 1,
                    $acadimic_year_semesters
                        ->where('year', '2015')
                        ->where('semester', 0)
                        ->first()
                        ->id,
                    'is_open_for_students' => false,
                ],
                [
                    'id' => 5,
                    'department_id' => 1,
                    $acadimic_year_semesters
                        ->where('year', '2015')
                        ->where('semester', 1)
                        ->first()
                        ->id,
                    'is_open_for_students' => false,
                ],
                [
                    'id' => 6,
                    'department_id' => 1,
                    $acadimic_year_semesters
                        ->where('year', '2015')
                        ->where('semester', 2)
                        ->first()
                        ->id,
                    'is_open_for_students' => false,
                ],
                [
                    'id' => 7,
                    'department_id' => 1,
                    $acadimic_year_semesters
                        ->where('year', '2016')
                        ->where('semester', 0)
                        ->first()
                        ->id,
                    'is_open_for_students' => true,
                ],
                [
                    'id' => 8,
                    'department_id' => 2,
                    $acadimic_year_semesters
                        ->where('year', '2014')
                        ->where('semester', 0)
                        ->first()
                        ->id,
                    'is_open_for_students' => false,
                ],
                [
                    'id' => 9,
                    'department_id' => 2,
                    $acadimic_year_semesters
                        ->where('year', '2014')
                        ->where('semester', 1)
                        ->first()
                        ->id,
                    'is_open_for_students' => true,
                ],
            ]);
    }
}
