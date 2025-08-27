<?php

namespace Database\Seeders;

use App\Models\AcademicYearSemester;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Context;

class AcademicYearSemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicYearSemester::factory()
            ->OpenFromYearToYearForEachSequence(2014, 2016)
            ->create();

        Context::add(
            'academic_year_semesters',
            AcademicYearSemester::all()
        );

    }
}
