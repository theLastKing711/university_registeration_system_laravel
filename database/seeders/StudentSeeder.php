<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->fromItDepartment()
            ->enrolledInYear(2014)
            ->unGraduated()
            ->count(10)
            ->create();

        User::factory()
            ->fromItDepartment()
            ->enrolledInYear(2013)
            ->graduatedInYear(2018)
            ->count(10)
            ->create();

    }
}
