<?php

namespace Tests\Feature\Admin\Exam;

use App\Data\Admin\Exam\AssignMarkToStudent\Request\AssignMarkToStudentRequestData;
use App\Data\Admin\Exam\AssignMarkToStudent\Request\ExamStudentItemData;
use App\Data\Admin\Exam\CreateExam\Request\CreateExamRequestData;
use App\Data\Admin\Exam\DeleteExam\Request\DeleteExamRequestData;
use App\Data\Admin\Exam\UpdateExam\Request\UpdateExamRequestData;
use App\Data\Admin\Exam\UpdateStudentExamMark\Request\ExamStudentItemData as RequestExamStudentItemData;
use App\Data\Admin\Exam\UpdateStudentExamMark\Request\UpdateStudentExamMarkRequestData;
use App\Models\Classroom;
use App\Models\CourseTeacher;
use App\Models\Exam;
use App\Models\ExamStudent;
use App\Models\User;
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
use Illuminate\Support\Collection;
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

        $response = $this->patchJson(
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
    public function delete_exam_with_200_response(): void
    {

        $exam =
            Exam::query()
                ->first();

        $delete_exam_request =
            new DeleteExamRequestData(
                $exam->id
            );

        $show_route =
            $this->getShowRoute($this->main_route, $exam->id);

        $response = $this->deleteJson(
            $show_route,
            $delete_exam_request->toArray()

        );

        $response->assertStatus(200);
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
            $this
                ->getShowRoute($this->main_route, $exam->id);

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

    #[Test]
    public function assign_mark_to_students_with_200_response(): void
    {

        $exam_student_count_before_request =
            ExamStudent::query()
                ->count();

        $exam =
            Exam::query()
                ->with('courseTeacher.course.students')
                ->first();

        $exam_students =
            $exam
                ->courseTeacher
                ->course
                ->students;

        /** @var Collection<ExamStudentItemData> $exam_students_data description */
        $exam_students_data =
           $exam_students
               ->map(callback: function ($student) {

                   return new ExamStudentItemData(
                       student_id: $student->id,
                       mark: fake()->numberBetween(30, 70)
                   );
               });

        $assign_mark_mark_to_students_request =
            new AssignMarkToStudentRequestData(
                $exam_students_data,
                $exam->course_teacher_id,
            );

        $assign_mark_to_stuends_route =
           $this
               ->getShowRoute($this->main_route, $exam->id)
               .
               '/students';

        $response = $this->postJson(
            $assign_mark_to_stuends_route,
            $assign_mark_mark_to_students_request->toArray()

        );

        $response->assertStatus(200);

        $this
            ->assertDatabaseCount(
                ExamStudent::class,
                $exam_student_count_before_request
                    +
                    $exam_students->count()
            );
    }

    #[Test]
    public function assign_mark_to_students_fails_student_unregistered_in_course_validation_with_422_response(): void
    {

        $exam_student_count_before_request =
            ExamStudent::query()
                ->count();

        $exam =
            Exam::query()
                ->with('courseTeacher.course.students')
                ->first();

        $exam_students =
            $exam
                ->courseTeacher
                ->course
                ->students;

        $users_not_registered_in_exam_coruse =
            User::query()
                ->whereNotIn(
                    'id',
                    $exam_students->pluck('id')
                )
                ->take(1)
                ->get();

        /** @var Collection<ExamStudentItemData> $exam_students_data description */
        $exam_students_data =
            $users_not_registered_in_exam_coruse
                ->map(callback: function ($student) {

                    return new ExamStudentItemData(
                        student_id: $student->id,
                        mark: fake()->numberBetween(30, 70)
                    );
                });

        $assign_mark_mark_to_students_request =
            new AssignMarkToStudentRequestData(
                $exam_students_data,
                $exam->course_teacher_id,
            );

        $assign_mark_to_stuends_route =
           $this
               ->getShowRoute($this->main_route, $exam->id)
               .
               '/students';

        $response = $this->postJson(
            $assign_mark_to_stuends_route,
            $assign_mark_mark_to_students_request->toArray()

        );

        $response->assertStatus(422);

        $response
            ->assertOnlyJsonValidationErrors(
                [
                    'exam_students.0.student_id' => __(
                        'messages.exam_students.student unregistered in course',
                        [
                            'id' => $users_not_registered_in_exam_coruse->first()->id,
                        ]
                    ),
                ]
            );

    }

    #[Test]
    public function update_student_exam_mark_with_200_response(): void
    {
        $exam =
            Exam::query()
                ->with('courseTeacher.course.students')
                ->first();

        $exam_students =
            ExamStudent::query()
                ->where(
                    'exam_id',
                    $exam->id
                )
                ->get();

        // /** @var Collection<RequestExamStudentItemData> $exam_students_data */
        $exam_students_data =
            $exam_students
                ->map(callback: function ($exam_student) {

                    return new RequestExamStudentItemData(
                        $exam_student->id,
                        student_id: $exam_student->student_id,
                        mark: fake()->numberBetween(30, 70)
                    );
                });

        $update_student_exam_mark_request =
            new UpdateStudentExamMarkRequestData(
                $exam_students_data,
                $exam->course_teacher_id,
            );

        $update_student_exam_mark_route =
           $this
               ->getShowRoute($this->main_route, $exam->id)
               .
               '/students';

        $response = $this->patchJson(
            $update_student_exam_mark_route,
            $update_student_exam_mark_request->toArray()

        );

        $exam_student_after_request =
            ExamStudent::query()
                ->where(
                    'exam_id',
                    $exam->id
                )
                ->select('exam_id', 'student_id', 'mark')
                ->get();

        $response->assertStatus(200);

        // work only  on elequent's collection that is why we passed elequent collection to diff argument instead of spatie data collection
        // number and order of selected fields in both collections must be the same for it to return desired result here
        $all_exam_students_has_been_updated =
            $exam_students_data->map(fn ($request_exam_student_item) => new ExamStudent([
                'exam_id' => $exam->id,
                'student_id' => $request_exam_student_item->student_id,
                'mark' => $request_exam_student_item->mark,
            ]))
                ->diff($exam_student_after_request)
                ->isEmpty();

        $this
            ->assertTrue(
                $all_exam_students_has_been_updated
            );

        // $exam_students
        //     ->diffAssocUsing(json_decode($exam_students_data), function ($exam_student_index, $exam_students_data_index) {

        //         return 0;
        //         // $exam_student = $exam_students->first();

        //         // $exam_student_data = $exam_students_data->slice($exam_students_data_index, 1);

        //         // if (
        //         //     $exam_student->exam_id === $update_student_exam_mark_request->id
        //         //     // &&
        //         //     // $exam_student->mark === $exam_students_data->mark
        //         //     // &&
        //         //     // $exam_student->student_id === $exam_student_data->student_id
        //         // ) {
        //         //     return 0;
        //         // }

        //         // return 1;
        //     });

    }
}
