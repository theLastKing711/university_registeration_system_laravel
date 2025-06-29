<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DepartmentRegisterationPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(
            'department_registeration_periods'
        )
            ->insert([
                [
                    'department_id' => 1,
                    'academic_year_semester_id' => 1,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'academic_year_semester_id' => 2,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'academic_year_semester_id' => 3,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'academic_year_semester_id' => 4,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'academic_year_semester_id' => 5,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'academic_year_semester_id' => 6,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'academic_year_semester_id' => 7,
                    'is_open_for_students' => true,
                ],
                [
                    'department_id' => 2,
                    'academic_year_semester_id' => 1,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 2,
                    'academic_year_semester_id' => 2,
                    'is_open_for_students' => true,
                ],
            ]);
    }
}
