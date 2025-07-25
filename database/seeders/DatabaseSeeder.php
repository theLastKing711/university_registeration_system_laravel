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
            AcademicYearSemesterSeeder::class,
            RolesAndPermissionsSeeder::class,
            DepartmentSeeder::class,
            ClassroomSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            UsdCurrencyExchangeRateSeeder::class,
            OpenCourseRegisterationSeeder::class,
            StudentSeeder::class,
            CourseTeacherSeeder::class,
            ClassroomCourseTeacherSeeder::class,
            ExamSeeder::class,
            LectureSeeder::class,
            CourseAttendanceSeeder::class,
            ExamStudentSeeder::class,
            AdminSeeder::class,
            DepartmentRegisterationPeriodSeeder::class,
            CourseRegistererSeeder::class,
            MarkAssignerSeeder::class,
        ]);
    }
}
