<?php

namespace Tests\Feature\Admin\Exam;

use App\Data\Admin\Exam\CreateExam\Request\CreateExamRequestData;
use App\Data\Admin\Exam\UpdateExam\Request\UpdateExamRequestData;
use App\Models\Classroom;
use App\Models\CourseTeacher;
use App\Models\Exam;
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
use Tests\Feature\Admin\Admin\AdminTest;

class ExamTest extends AdminTest
{
    private string $main_route = '/admins/exams';

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            AcademicYearSemesterSeeder::class,
            DepartmentSeeder::class,
            ClassroomSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            OpenCourseRegisterationSeeder::class,
            StudentSeeder::class,
            CourseTeacherSeeder::class,
            ExamStudentSeeder::class,
            // DepartmentRegisterationPeriodSeeder::class,
        ]);
    }

    #[Test]
    public function get_exam_with_200_response(): void
    {

        $first_exam =
            Exam::first();

        $show_route =
            $this
                ->getShowRoute($this->main_route, $first_exam->id);

        $response =
            $this
                ->getJson(
                    $show_route
                );

        $response->assertStatus(200);

    }

    #[Test]
    public function create_exam_with_200_response(): void
    {

        Exam::query()
            ->delete();

        $exams_count_beofre_request =
            Exam::query()->count();

        $course_teacher =
            CourseTeacher::first();

        $classroom =
            Classroom::first();

        $create_exam_request =
            new CreateExamRequestData(
                $course_teacher->id,
                $classroom->id,
                30,
                '2014-05-01',
                '08:00:00',
                '10:00:00',
                true
            );

        $response =
            $this
                ->postJson(
                    $this->main_route,
                    $create_exam_request->toArray()

                );

        $response->assertStatus(200);

        $exam_has_been_created =
            Exam::query()
                ->where([
                    'course_teacher_id' => $create_exam_request->course_teacher_id,
                    'classroom_id' => $create_exam_request->classroom_id,
                    'date' => $create_exam_request->date,
                    'from' => $create_exam_request->from,
                    'to' => $create_exam_request->to,
                ])
                ->first()
                !=
                null;

        $this
            ->assertDatabaseCount(
                Exam::class,
                $exams_count_beofre_request + 1
            );

        $this
            ->assertTrue(
                $exam_has_been_created
            );

    }

    #[Test]
    public function create_overlapping_exam_fails_validation_with_422_response(): void
    {
        $exams_count_beofre_request =
            Exam::query()->count();

        $overlapped_exam =
            Exam::query()
                ->with('courseTeacher.course.course')
                ->first();

        $create_exam_request =
            new CreateExamRequestData(
                $overlapped_exam->course_teacher_id,
                $overlapped_exam->classroom_id,
                $overlapped_exam->max_mark,
                $overlapped_exam->date,
                $overlapped_exam->from,
                $overlapped_exam->to,
                $overlapped_exam->is_main_exam
            );

        $response =
            $this
                ->postJson(
                    $this->main_route,
                    $create_exam_request->toArray()

                );

        $response->assertStatus(422);

        $overrlapped_course_name =
          $overlapped_exam->courseTeacher->course->course->name;

        $response
            ->assertOnlyJsonValidationErrors(
                [
                    'from' => __(
                        'messages.exams.overlap',
                        ['course_name' => $overrlapped_course_name]
                    ),
                ]
            );

        $this
            ->assertDatabaseCount(
                Exam::class,
                $exams_count_beofre_request
            );

    }

    #[Test]
    public function update_exam_with_200_response(): void
    {

        $safe_update_exam =
            Exam::query()
                ->first();

        $safe_update_exam
            ->delete();

        $exam =
            Exam::query()
                ->first();

        $update_exam_request =
            new UpdateExamRequestData(
                $safe_update_exam->course_teacher_id,
                $safe_update_exam->classroom_id,
                $safe_update_exam->max_mark,
                $safe_update_exam->date,
                $safe_update_exam->from,
                $safe_update_exam->to,
                $safe_update_exam->is_main_exam,
                $exam->id
            );

        $show_route =
            $this->getShowRoute($this->main_route, $exam->id);

        $response = $this->patch(
            $show_route,
            $update_exam_request->toArray()

        );

        $response->assertStatus(200);

        $exam_has_been_updated =
            Exam::query()
                ->where([
                    'id' => $exam->id,
                    'course_teacher_id' => $update_exam_request->course_teacher_id,
                    'classroom_id' => $update_exam_request->classroom_id,
                    'max_mark' => $update_exam_request->max_mark,
                    'date' => $update_exam_request->date,
                    'from' => $update_exam_request->from,
                    'to' => $update_exam_request->to,
                    'is_main_exam' => $update_exam_request->is_main_exam,
                ])
                ->first() != null;

        $this
            ->assertTrue(
                $exam_has_been_updated
            );

    }

    #[Test]
    public function update_overlapped_exam_fails_with_422_response(): void
    {

        $overlapped_exam =
            Exam::query()
                ->first();
        $exam =
            Exam::query()
                ->with('courseTeacher.course.course')
                ->where(
                    'id',
                    '!=',
                    $overlapped_exam
                        ->id
                )
                ->first();

        $update_exam_request =
            new UpdateExamRequestData(
                $overlapped_exam->course_teacher_id,
                $overlapped_exam->classroom_id,
                $overlapped_exam->max_mark,
                $overlapped_exam->date,
                $overlapped_exam->from,
                $overlapped_exam->to,
                $overlapped_exam->is_main_exam,
                $exam->id
            );

        $show_route =
            $this->getShowRoute($this->main_route, $exam->id);

        $response = $this->patchJson(
            $show_route,
            $update_exam_request->toArray()

        );

        $response->assertStatus(422);

        $overrlapped_course_name =
         $overlapped_exam->courseTeacher->course->course->name;

        $response
            ->assertOnlyJsonValidationErrors(
                [
                    'from' => __(
                        'messages.exams.overlap',
                        ['course_name' => $overrlapped_course_name]
                    ),
                ]
            );

    }

    // #[Test]
    // public function get_department_teachers_with_200_response(): void
    // {

    //     $first_department =
    //         Department::first();

    //     $department_teacher_routes =
    //         $this->main_route
    //         .
    //         '/'.
    //         $first_department->id
    //         .
    //         '/'
    //         .
    //         'teachers';

    //     $response =
    //         $this
    //             ->getJson(
    //                 $department_teacher_routes
    //             );

    //     $response->assertStatus(200);

    // }
}
