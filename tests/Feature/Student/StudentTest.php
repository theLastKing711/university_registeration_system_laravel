<?php

namespace Tests\Feature\Student;

use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CourseTeacherSeeder;
use Database\Seeders\DepartmentRegisterationPeriodSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\ExamStudentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\TeacherSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Student\Abstractions\StudentTestCase;

class StudentTest extends StudentTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths('teachers');

        $this->
            seed([
                AcademicYearSemesterSeeder::class,
                DepartmentSeeder::class,
                ClassroomSeeder::class,
                TeacherSeeder::class,
                // CourseSeeder::class,
                // OpenCourseRegisterationSeeder::class,
                // StudentSeeder::class,
                // CourseTeacherSeeder::class,
                // ExamStudentSeeder::class,
                // DepartmentRegisterationPeriodSeeder::class,
            ]);

    }

    // get_teachers
    #[Test]
    public function get_open_courses_this_semester_with_200_response(): void
    {

        $response =
            $this->getJsonData();

        $response->assertStatus(200);

    }
}
