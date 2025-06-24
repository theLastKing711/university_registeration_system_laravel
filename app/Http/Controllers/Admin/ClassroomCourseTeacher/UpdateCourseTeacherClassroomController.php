<?php

namespace App\Http\Controllers\Admin\ClassroomCourseTeacher;

use App\Data\Admin\ClassroomCourseTeacher\UpdateCourseTeacherClassroom\Request\UpdateCourseTeacherClassroomRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\Abstract\ClassroomCourseTeacherController;
use App\Models\ClassroomCourseTeacher;
use OpenApi\Attributes as OAT;

class UpdateCourseTeacherClassroomController extends ClassroomCourseTeacherController
{
    #[OAT\Patch(path: '/admins/classroom-course-teachers/{id}', tags: ['adminsClassroomCourseTeachers'])]
    #[JsonRequestBody(UpdateCourseTeacherClassroomRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateCourseTeacherClassroomRequestData $request)
    {

        ClassroomCourseTeacher::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update([
                'classroom_id' => $request->classroom_id,
                'course_teacher_id' => $request->course_teacher_id,
                'day' => $request->day,
                'from' => $request->from,
                'to' => $request->to,
            ]);

    }
}
