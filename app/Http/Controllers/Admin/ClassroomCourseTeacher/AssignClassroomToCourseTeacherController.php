<?php

namespace App\Http\Controllers\Admin\ClassroomCourseTeacher;

use App\Data\Admin\ClassroomCourseTeacher\AssignClassroomToCourseTeacher\Request\AssignClassroomToCourseTeacherRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class AssignClassroomToCourseTeacherController extends Controller
{
    #[OAT\Post(path: '/admins/classroom-course-teachers', tags: ['adminsClassroomCourseTeachers'])]
    #[JsonRequestBody(AssignClassroomToCourseTeacherRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignClassroomToCourseTeacherRequestData $request)
    {

        CourseTeacher::query()
            ->firstWhere('id', $request->course_teacher_id)
            ->classrooms()
            ->attach(
                $request->classroom_id,
                [
                    'day' => $request->day,
                    'from' => $request->from,
                    'to' => $request->to,
                ]
            );

    }
}
