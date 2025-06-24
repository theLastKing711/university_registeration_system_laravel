<?php

namespace App\Http\Controllers\Admin\ClassroomCourseTeacher;

use App\Data\Admin\ClassroomCourseTeacher\DeleteClassroomCourseTeacherClassroom\Request\DeleteClassroomCourseTeacherRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\Abstract\ClassroomCourseTeacherController;
use App\Models\ClassroomCourseTeacher;
use OpenApi\Attributes as OAT;

class DeleteClassroomCourseTeacherController extends ClassroomCourseTeacherController
{
    #[OAT\Delete(path: '/admins/classroom-course-teachers/{id}', tags: ['adminsClassroomCourseTeachers'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteClassroomCourseTeacherRequestData $request)
    {

        ClassroomCourseTeacher::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();

    }
}
