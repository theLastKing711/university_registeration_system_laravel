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
use App\Models\OpenCourseRegisteration;
use App\Models\User;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CourseTeacherSeeder;
use Database\Seeders\DepartmentSeeder;
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
        ]);
    }

    // get_exam
    #[Test]
    public function get_exam_with_200_response(): void
    {

        $exam = Exam::factory()
            ->withRandomFromTo()
            ->create();

        $response =
            $this
                ->withRoutePaths(
                    $exam->id
                )
                ->getJsonData();

        $response->assertStatus(200);

    }

    // create_exam
    #[Test]
    public function create_exam_with_200_response(): void
    {

        $course_teacher =
            CourseTeacher::factory()
                ->create();

        $classroom =
            Classroom::factory()
                ->create();

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

        $this
            ->assertDatabaseCount(
                Exam::class,
                1
            );

        $this
            ->assertDatabaseHas(
                Exam::class,
                [
                    'course_teacher_id' => $course_teacher->id,
                    'classroom_id' => $classroom->id,
                    'max_mark' => $create_exam_request->max_mark,
                    'date' => $create_exam_request->date,
                    'from' => $create_exam_request->from,
                    'to' => $create_exam_request->to,
                    'is_main_exam' => $create_exam_request->is_main_exam,
                ]
            );

    }

    #[Test]
    public function create_exam_fails_overlap_validation_with_422_response(): void
    {
        $exam_to_overlap_with =
            Exam::factory()
                ->withRandomFromTo()
                ->create();

        $create_exam_request =
            new CreateExamRequestData(
                $exam_to_overlap_with->course_teacher_id,
                $exam_to_overlap_with->classroom_id,
                $exam_to_overlap_with->max_mark,
                $exam_to_overlap_with->date,
                $exam_to_overlap_with->from,
                $exam_to_overlap_with->to,
                $exam_to_overlap_with->is_main_exam
            );

        $response =
            $this
                ->postJsonData(
                    $create_exam_request->toArray()
                );

        $response->assertStatus(422);

        $this
            ->assertDatabaseCount(
                Exam::class,
                1
            );

        $overrlapped_course_name =
          $exam_to_overlap_with
              ->courseTeacher
              ->course
              ->course
              ->name;

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

    // assign_mark_to_students
    #[Test]
    public function assign_mark_to_students_with_200_response(): void
    {
        $exam =
            Exam::factory()
                ->withRandomFromTo()
                ->has(
                    CourseTeacher::factory()
                        ->has(
                            OpenCourseRegisteration::factory()
                                ->hasAttached(
                                    User::factory()
                                        ->count(count: 5),
                                    ['final_mark' => 40],
                                    'students'
                                )
                        )
                )
                ->create();

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

        $exam_students_data
            ->each(function ($exam_student) use ($exam) {
                $this
                    ->assertDatabaseHas(
                        ExamStudent::class,
                        [
                            'exam_id' => $exam->id,
                            'student_id' => $exam_student->student_id,
                            'mark' => $exam_student->mark,
                        ]
                    );
            });
    }

    #[Test]
    public function assign_mark_to_students_fails_with_student_unregistered_in_course_validation_with_422_response(): void
    {

        $exam =
           Exam::factory()
               ->withRandomFromTo()
               ->for(
                   CourseTeacher::factory()
                       ->for(
                           OpenCourseRegisteration::factory()
                               ->hasAttached(
                                   User::factory()
                                       ->withStudentRole()
                                       ->count(count: 5),
                                   ['final_mark' => 40],
                                   'students'
                               ),
                           'course'
                       )
               )
               ->create();

        $exam_students =
            $exam
                ->courseTeacher
                ->course
                ->students;

        $users_unregistered_in_exam_coruse =
            User::factory()
                ->withStudentRole()
                ->count(3)
                ->create();

        /** @var Collection<ExamStudentItemData> $exam_students_data */
        $exam_students_data =
            $users_unregistered_in_exam_coruse
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
            ->assertJsonValidationErrors(
                [
                    'exam_students.0.student_id' => __(
                        'messages.exam_students.student unregistered in course',
                        [
                            'id' => $users_unregistered_in_exam_coruse->first()->id,
                        ]
                    ),
                ]
            );

    }

    // update_student_exam_mark
    #[Test]
    public function update_student_exam_mark_with_200_response(): void
    {

        $open_course_students =
            User::factory(3)
                ->withStudentRole()
                ->create();
        $exam =
         Exam::factory()
             ->withRandomFromTo()
             ->for(
                 CourseTeacher::factory()
                     ->for(
                         OpenCourseRegisteration::factory()
                             ->hasAttached(
                                 $open_course_students,
                                 ['final_mark' => 40],
                                 'students'
                             ),
                         'course'
                     )
             )
             ->hasAttached(
                 $open_course_students,
                 fn ($data) => ['mark' => fake()->numberBetween(30, 70)],
                 'students'
             )
             ->create();

        $exam_students =
            $exam
                ->examStudents;

        $this
            ->assertNotEmpty(
                $exam->courseTeacher->course->students
            );

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
        $open_course_students =
            User::factory()
                ->withStudentRole()
                ->create();
        $exam =
         Exam::factory()
             ->withRandomFromTo()
             ->for(
                 CourseTeacher::factory()
                     ->for(
                         OpenCourseRegisteration::factory()
                             ->hasAttached(
                                 $open_course_students,
                                 ['final_mark' => 40],
                                 'students'
                             ),
                         'course'
                     )
             )
             ->hasAttached(
                 $open_course_students,
                 fn ($data) => ['mark' => fake()->numberBetween(30, 70)],
                 'students'
             )
             ->create();

        /** @var Collection<User> $student_unregistered_in_exam_course */
        $student_unregistered_in_exam_course =
            User::factory()
                ->withStudentRole()
                ->create();

        $exam_students =
            $exam
                ->examStudents;

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
            ->assertJsonValidationErrors(
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
    public function update_exam_fails_overlap_validation_with_422_response(): void
    {

        $exam_to_overlap_with =
            Exam::factory()
                ->withRandomFromTo()
                ->create();
        $exam =
            Exam::factory()
                ->withRandomFromTo()
                ->create();

        $update_exam_request =
            new UpdateExamRequestData(
                $exam_to_overlap_with->course_teacher_id,
                $exam_to_overlap_with->classroom_id,
                $exam_to_overlap_with->max_mark,
                $exam_to_overlap_with->date,
                $exam_to_overlap_with->from,
                $exam_to_overlap_with->to,
                $exam_to_overlap_with->is_main_exam,
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
         $exam_to_overlap_with->courseTeacher->course->course->name;

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
            Exam::factory()
                ->withRandomFromTo()
                ->create();

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
