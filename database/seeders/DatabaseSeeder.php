<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClassroomSeeder::class,
            // OpenCourseRegisterationSeeder::class,
            TeacherSeeder::class,
            DepartmentSeeder::class,
            StudentSeeder::class,
            // CourseSeeder::class,
            // RolesAndPermissionsSeeder::class,
            // AdminSeeder::class,
        ]);
    }
}
