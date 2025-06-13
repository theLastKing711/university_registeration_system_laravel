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
                    'year' => 2014,
                    'semester' => 0,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'year' => 2014,
                    'semester' => 1,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'year' => 2014,
                    'semester' => 2,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'year' => 2015,
                    'semester' => 0,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'year' => 2015,
                    'semester' => 1,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'year' => 2015,
                    'semester' => 2,
                    'is_open_for_students' => false,
                ],
                [
                    'department_id' => 1,
                    'year' => 2016,
                    'semester' => 1,
                    'is_open_for_students' => true,
                ],
            ]);
    }
}
