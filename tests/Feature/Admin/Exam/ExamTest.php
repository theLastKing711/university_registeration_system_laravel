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
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\ExamSeeder;
use Database\Seeders\ExamStudentSeeder;
use Database\Seeders\OpenCourseRegisterationSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\TeacherSeeder;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;

class ExamTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->route_builder
            ->withPaths('exams');

        $this->seed([
            AcademicYearSemesterSeeder::class,
            DepartmentSeeder::class,
            ClassroomSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            OpenCourseRegisterationSeeder::class,
            StudentSeeder::class,
            CourseTeacherSeeder::class,
            ExamSeeder::class,
            ExamStudentSeeder::class,
        ]);
    }

    // get_exam
    #[Test]
    public function get_exam_with_200_response(): void
    {

        $first_exam =
            Exam::first();

        $response =
            $this
                ->withRoutePaths(
                    $first_exam->id
                )
                ->getJsonData();

        $response->assertStatus(200);

    }

    // create_exam
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
                ->postJsonData(
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
                ->postJsonData(
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

    // assign_mark_to_students
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

        $response = $this
            ->withRoutePaths(
                $exam->id,
                'students'
            )->postJsonData(
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
    public function assign_mark_to_students_fails_with_student_unregistered_in_course_validation_with_422_response(): void
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

        $response = $this
            ->withRoutePaths(
                $exam->id,
                'students'
            )
            ->postJsonData(
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

    // update_student_exam_mark
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

        $response = $this
            ->withRoutePaths(
                $exam->id,
                'students'
            )
            ->patchJsonData(
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

        // a possible replacment for diff solution above
        // $exam_students_data->each(function ($exam_student_data) use ($exam) {
        //     $this
        //         ->assertDatabaseHas(
        //             ExamStudent::class,
        //             [
        //                 'exam_id' => $exam->id,
        //                 'student_id' => $exam_student_data->student_id,
        //                 'mark' => $exam_student_data->mark,
        //             ],
        //         );
        // });

    }

    #[Test]
    public function update_student_exam_mark_fails_student_unregistered_in_course_validation_with_422_response(): void
    {
        $exam =
            Exam::query()
                ->with('courseTeacher.course.students')
                ->first();

        $student_unregistered_in_exam_course =
            User::query()
                ->whereNotIn(
                    'id',
                    $exam->courseTeacher->course->students->pluck('id')
                )
                ->first();

        $exam_students =
            ExamStudent::query()
                ->where(
                    'exam_id',
                    $exam->id
                )
                ->take(1)
                ->get();

        // /** @var Collection<RequestExamStudentItemData> $exam_students_data */
        $exam_students_data =
            $exam_students
                ->map(callback: function ($exam_student) use ($student_unregistered_in_exam_course) {

                    return new RequestExamStudentItemData(
                        $exam_student->id,
                        student_id: $student_unregistered_in_exam_course->id,
                        mark: fake()->numberBetween(30, 70)
                    );
                });

        $update_student_exam_mark_request =
            new UpdateStudentExamMarkRequestData(
                $exam_students_data,
                $exam->course_teacher_id,
            );

        $response = $this
            ->withRoutePaths(
                $exam->id,
                'students'
            )
            ->patchJsonData(
                $update_student_exam_mark_request->toArray()

            );

        $response->assertStatus(422);

        $response
            ->assertOnlyJsonValidationErrors(
                [
                    'exam_students.0.student_id' => __(
                        'messages.exam_students.student unregistered in course',
                        [
                            'id' => $student_unregistered_in_exam_course->id,
                        ]
                    ),
                ]
            );

    }

    // update_exam
    #[Test]
    public function update_exam_with_200_response(): void
    {

        // or we don't seed it in set up, and seed it only when needed
        Exam::query()
            ->delete();

        $exam =
            Exam::factory()
                ->withRandomFromTo()
                ->withRandomExamDate(2014, 0)
                ->withCourseTeacherId(CourseTeacher::first()->id)
                ->create();

        $update_exam_request =
            new UpdateExamRequestData(
                CourseTeacher::first()->id,
                Classroom::first()->id,
                40,
                fake()->date(),
                '04:00:00',
                '06:00:00',
                true,
                $exam->id
            );

        $response =
            $this
                ->withRoutePaths(
                    $exam->id
                )
                ->patchJsonData(
                    $update_exam_request->toArray()

                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                Exam::class,
                [
                    'id' => $exam->id,
                    'course_teacher_id' => $update_exam_request->course_teacher_id,
                    'classroom_id' => $update_exam_request->classroom_id,
                    'max_mark' => $update_exam_request->max_mark,
                    'date' => $update_exam_request->date,
                    'from' => $update_exam_request->from,
                    'to' => $update_exam_request->to,
                    'is_main_exam' => $update_exam_request->is_main_exam,
                ]
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

        $response = $this
            ->withRoutePaths(
                $exam->id
            )
            ->patchJsonData(
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

    // delete_exam
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

        $response = $this
            ->withRoutePaths(
                $exam->id
            )
            ->deleteJsonData(
                $delete_exam_request->toArray()

            );

        $response->assertStatus(200);
    }
}
