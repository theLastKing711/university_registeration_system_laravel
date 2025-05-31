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
            TeacherSeeder::class,
            ClassroomSeeder::class,
            // OpenCourseRegisterationSeeder::class,
            DepartmentSeeder::class,
            // CourseSeeder::class,
            // StudentSeeder::class,
            // RolesAndPermissionsSeeder::class,
            // AdminSeeder::class,
        ]);
    }
}
