<?php

namespace Database\Seeders;

use App\Enum\Auth\RolesEnum;
use App\Models\OpenCourseRegisteration;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Context;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $it_courses =
        //     OpenCourseRegisteration::query()
        //         ->whereRelation('course.department', 'id', 1)
        //         ->get();

        User::factory()
            ->withStudentRole()
            ->fromItDepartment()
            ->withProfilePicture()
            ->enrolledInYear(2014)
            ->unGraduated()
            // ->withCourses()
            ->count(count: 3)
            // ->hasAttached(
            //     $it_courses,
            //     fn (): mixed => ['final_mark' => fake()->numberBetween(30, 100)], // runs once per it_course
            //     'courses' // the many to many relation for User Model we insert for $it_course
            // )
            ->create();

        User::factory()
            ->state([
                'name' => 'it_student',
                'password' => Hash::make('it_student'),
            ])
            ->withStudentRole()
            ->fromItDepartment()
            ->withProfilePicture()
            ->enrolledInYear(2015)
            ->unGraduated()
            // ->withCourses()
            ->count(count: 1)
            ->create();

        // User::factory()
        //     ->fromItDepartment()
        //     ->enrolledInYear(2013)
        //     ->graduatedInYear(2018)
        //     ->count(10)
        //     ->create();

        Context::add(
            'students',
            User::query()
                ->role(RolesEnum::STUDENT)
                ->get()

        );

    }
}
