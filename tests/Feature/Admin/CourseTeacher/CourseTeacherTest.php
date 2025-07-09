<?php

namespace Tests\Feature\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\CreateCourseTeacherAttendance\Request\CreateCourseTeacherAttendanceRequestData;
use App\Data\Admin\CourseTeacher\CreateCourseTeacherAttendance\Request\StudentAttendanceData;
use App\Data\Admin\CourseTeacher\GetCourseTeacherExams\Response\GetCourseTeacherExamsResponseData;
use App\Data\Admin\CourseTeacher\GetCourseTeacherStudents\Response\GetCourseTeacherStudentsRespnseData;
use App\Data\Admin\CourseTeacher\UpdateCourseTeacherAttendace\Request\StudentAttendanceItemData;
use App\Data\Admin\CourseTeacher\UpdateCourseTeacherAttendace\Request\UpdateCourseTeacherAttandenceRequestData;
use App\Models\CourseAttendance;
use App\Models\CourseTeacher;
use App\Models\Lecture;
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

class CourseTeacherTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths(
                'course-teachers'
            );

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

    #[Test]
    public function get_course_teacher_lectures_with_200_response(): void
    {

        $first_course_teacher =
            CourseTeacher::query()
                ->has('lectures')
                ->first();

        $response =
            $this
                ->withRoutePaths(
                    $first_course_teacher->id,
                    'lectures'
                )

                ->getJsonData();

        $response->assertStatus(200);

    }

    #[Test]
    public function create_course_teacher_student_attendance_with_200_response(): void
    {

        $first_course_teacher =
             CourseTeacher::query()
                 ->with('course.students')
                 ->first();

        $course_students_count =
            $first_course_teacher
                ->course
                ->students
                ->count();

        $course_attendance_count_before_request =
            CourseAttendance::query()
                ->count();

        $course_teacher_attendance_data =
            $first_course_teacher
                ->course
                ->students
                ->map(function ($student) {
                    return new StudentAttendanceData(
                        $student->id,
                        fake()->boolean
                    );
                });

        $attendance_count =
            CourseAttendance::query()
                ->whereRelation(
                    'lecture.courseTeacher',
                    'id',
                    $first_course_teacher->id
                )->get();

        $response =
            $this
                ->withRoutePaths(
                    $first_course_teacher->id,
                    'lectures'
                )
                ->postJsonData(
                    new CreateCourseTeacherAttendanceRequestData(
                        '2014-04-04',
                        $course_teacher_attendance_data,
                        $first_course_teacher->id,
                    )->toArray()
                );

        $response->assertStatus(200);

        $course_attendance_count_after_request =
            CourseAttendance::query()
                ->count();

        $this
            ->assertEquals(
                $course_attendance_count_after_request,
                $course_attendance_count_before_request
                +
                $course_students_count
            );

    }

    #[Test]
    public function update_course_teacher_student_attendance_with_200_response(): void
    {

        $random_lecture =
            Lecture::query()
                ->with(
                    'courseTeacher',
                    'students'
                )
                ->first();

        $course_teacher_attendance_data =
            $random_lecture
                ->courseTeacher
                ->course
                ->students
                ->map(function ($student) {
                    return new StudentAttendanceItemData(
                        $student->id,
                        fake()->boolean
                    );
                });

        $response =
            $this
                ->withRoutePaths(
                    $random_lecture->courseTeacher->id,
                    'lectures',
                    $random_lecture->id
                )
                ->patchJsonData(
                    new UpdateCourseTeacherAttandenceRequestData(
                        '2014-04-16',
                        $course_teacher_attendance_data,
                        $random_lecture->courseTeacher->id,
                        $random_lecture->id
                    )->toArray()
                );

        $response->assertStatus(200);

    }

    #[Test]
    public function delete_course_teacher_student_attendance_with_200_response(): void
    {

        $random_lecture =
            Lecture::query()
                ->with(
                    'courseTeacher',
                    'students'
                )
                ->first();

        $response =
            $this
                ->withRoutePaths(
                    $random_lecture->courseTeacher->id,
                    'lectures',
                    $random_lecture->id
                )
                ->deleteJsonData();

        $response->assertStatus(200);

    }

    #[Test]
    public function get_course_teacher_students_with_200_response(): void
    {

        $first_course_teacher =
            CourseTeacher::query()
                ->first();

        $response =
            $this
                ->withRoutePaths(
                    $first_course_teacher->id,
                    'students'
                )
                ->getJsonData();

        $response->assertStatus(200);

        /** @var Collection<GetCourseTeacherStudentsRespnseData> $resposne_data */
        $resposne_data =
            collect(
                GetCourseTeacherStudentsRespnseData::collect($response->json())
            );

        $this
            ->assertTrue(
                $resposne_data->first()->name != null
            );

    }

    #[Test]
    public function get_course_teacher_exams_with_200_response(): void
    {

        $first_course_teacher =
            CourseTeacher::query()
                ->first();

        $response =
            $this
                ->withRoutePaths(
                    $first_course_teacher->id,
                    'exams'
                )
                ->getJsonData();

        $response->assertStatus(200);

        /** @var Collection<GetCourseTeacherExamsResponseData> $resposne_data */
        $resposne_data =
            collect(
                GetCourseTeacherExamsResponseData::collect($response->json())
            );

        $this
            ->assertTrue(
                $resposne_data->count() > 0
            );

    }
}
