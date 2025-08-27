<?php

namespace App\Http\Controllers\Admin\ClassroomCourseTeacher;

use App\Data\Admin\ClassroomCourseTeacher\CreateClassroomCourseTeacher\Request\CreateClassroomCourseTeacherRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class CreateClassroomCourseTeacherController extends Controller
{
    #[OAT\Post(path: '/admins/classroom-course-teachers', tags: ['adminsClassroomCourseTeachers'])]
    #[JsonRequestBody(CreateClassroomCourseTeacherRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateClassroomCourseTeacherRequestData $request)
    {

        CourseTeacher::query()
            // ->firstWhere('id', $request->course_teacher_id)
            ->firstWhere(
                [
                    'course_id' => $request->course_id,
                    'teacher_id' => $request->teacher_id,
                ]
            )
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
