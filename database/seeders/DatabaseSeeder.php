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
            DepartmentSeeder::class,
            ClassroomSeeder::class,
            OpenCourseRegisterationSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            OpenCourseRegisterationSeeder::class,
            StudentSeeder::class,
            CourseTeacherSeeder::class,
            ExamStudentSeeder::class,
            RolesAndPermissionsSeeder::class,
            AdminSeeder::class,
            DepartmentRegisterationPeriodSeeder::class,
            CourseRegistererSeeder::class,
            MarkAssignerSeeder::class,
        ]);
    }
}
