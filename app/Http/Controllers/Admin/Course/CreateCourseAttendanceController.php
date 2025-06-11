<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\CreateCourseAttendanceRequestData;
use App\Data\Admin\Course\StudentAttendanceData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class CreateCourseAttendanceController extends Controller
{
    #[OAT\Post(path: '/admins/courses/createCourseAttendance', tags: ['adminsCourses'])]
    #[JsonRequestBody(CreateCourseAttendanceRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateCourseAttendanceRequestData $request)
    {

        $attendace_attach_data = [];

        $request
            ->students_attendance
            ->each(function (StudentAttendanceData $attendance) use (&$attendace_attach_data, $request) {
                $attendace_attach_data[$attendance->id] =
                    [
                        'is_student_present' => $attendance->is_present,
                        'date' => $request->date,
                    ];
            });

        CourseTeacher::query()
            ->firstWhere(
                'id',
                $request->course_teacher_id
            )
            ->studenAttendances()
            ->attach($attendace_attach_data);

    }
}
