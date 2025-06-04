<?php

namespace Database\Seeders;

use App\Models\OpenCourseRegisteration;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $it_courses =
            OpenCourseRegisteration::query()
                ->whereRelation('course.department', 'id', 1)
                ->get();

        User::factory()
            ->fromItDepartment()
            ->enrolledInYear(2014)
            ->unGraduated()
            ->count(count: 3)
            ->hasAttached(
                $it_courses,
                fn (): mixed => ['final_mark' => fake()->numberBetween(30, 100)], // runs once per it_course
                'courses' // the many to many relation for User Model we insert for $it_course
            )
            ->create();

        // User::factory()
        //     ->fromItDepartment()
        //     ->enrolledInYear(2013)
        //     ->graduatedInYear(2018)
        //     ->count(10)
        //     ->create();

    }
}
