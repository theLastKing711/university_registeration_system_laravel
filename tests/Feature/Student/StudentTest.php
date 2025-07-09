<?php

namespace Tests\Feature\Student;

use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Student\Abstractions\StudentTestCase;

class StudentTest extends StudentTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths('open-course-registerations');

        $this->
            seed([
            ]);

    }

    // get_teachers
    #[Test]
    public function get_open_courses_this_semester_with_200_response(): void
    {

        $response =
            $this
                ->getJsonData();

        $response
            ->assertStatus(200);
        //
    }

    // get_teachers
    #[Test]
    public function get_student_course_schedule_this_semester_with_200_response(): void
    {

        $response =
            $this
                ->withRoutePaths(
                    'schedule'
                )
                ->getJsonData();

        $response->assertStatus(200);
        //
    }
}
