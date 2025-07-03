<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\CreateCourseTeacherAttendance\Request\CreateCourseTeacherAttendanceRequestData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\CourseTeacher\Abstract\CourseTeacherController;
use App\Models\Lecture;
use DB;
use OpenApi\Attributes as OAT;

class CreateCourseTeacherAttendanceController extends CourseTeacherController
{
    #[OAT\Post(path: '/admins/course-teachers/{id]/lectures', tags: ['adminsCourseTeachers'])]
    #[QueryParameter('date')]
    #[JsonRequestBody(CreateCourseTeacherAttendanceRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateCourseTeacherAttendanceRequestData $request)
    {

        $attendace_attach_data = [];

        $request
            ->students_attendance
            ->each(function ($attendance) use (&$attendace_attach_data) {
                $attendace_attach_data[$attendance->id] =
                    [
                        'is_student_present' => $attendance->is_present,
                    ];
            });

        DB::transaction(function () use ($request, $attendace_attach_data) {

            $new_lecture = Lecture::create([
                'happened_at' => $request->happened_at,
            ]);

            Lecture::query()
                ->whereRelation(
                    'courseTeacher',
                    'id',
                    $request->id
                )
                ->first()
                ->students()
                ->attach($attendace_attach_data);

        });

    }
}
