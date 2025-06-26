<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\CreateCourseTeacherAttendance\Request\CreateCourseTeacherAttendanceRequestData;
use App\Data\Admin\CourseTeacher\CreateCourseTeacherAttendance\Request\StudentAttendanceData as RequestStudentAttendanceData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\CourseTeacher\Abstract\CourseTeacherAttendanceController;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class CreateCourseTeacherAttendanceController extends CourseTeacherAttendanceController
{
    #[OAT\Post(path: '/admins/course-teachers/course-attendances', tags: ['adminsCourseTeachers'])]
    #[QueryParameter('date')]
    #[JsonRequestBody(CreateCourseTeacherAttendanceRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateCourseTeacherAttendanceRequestData $request)
    {

        $attendace_attach_data = [];

        $request
            ->students_attendance
            ->each(function (RequestStudentAttendanceData $attendance) use (&$attendace_attach_data, $request) {
                $attendace_attach_data[$attendance->id] =
                    [
                        'is_student_present' => $attendance->is_present,
                        'date' => $request->date,
                    ];
            });

        CourseTeacher::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->studenAttendances()
            ->attach($attendace_attach_data);

    }
}
