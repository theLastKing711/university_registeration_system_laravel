<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\DeleteCourseTeacherAttendace\Request\DeleteCourseTeacherAttendanceRequestData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\CourseTeacher\Abstract\CourseTeacherAttendanceController;
use App\Models\CourseAttendance;
use OpenApi\Attributes as OAT;

class DeleteCourseTeacherAttendaceController extends CourseTeacherAttendanceController
{
    #[OAT\Delete(path: '/admins/course-teachers/{id}/students', tags: ['adminsCourseTeachers'])]
    #[QueryParameter('date')]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteCourseTeacherAttendanceRequestData $request)
    {

        CourseAttendance::query()
            ->where(
                'course_teacher_id',
                $request->id
            )
            ->where(
                'date',
                $request->date
            )
            ->delete();

    }
}
