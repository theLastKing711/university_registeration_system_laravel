<?php

namespace App\Http\Controllers\Admin\ClassroomCourseTeacher;

use App\Data\Admin\ClassroomCourseTeacher\GetClassroomCourseTeacher\Request\GetClassroomCourseTeacherRequestData;
use App\Data\Admin\ClassroomCourseTeacher\GetClassroomCourseTeacher\Response\GetClassroomCourseTeacherResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\Abstract\ClassroomCourseTeacherController;
use App\Models\ClassroomCourseTeacher;
use OpenApi\Attributes as OAT;

class GetClassroomCourseTeacherController extends ClassroomCourseTeacherController
{
    #[OAT\Get(path: '/admins/classroom-course-teachers/{id}', tags: ['adminsClassroomCourseTeachers'])]
    #[SuccessItemResponse(GetClassroomCourseTeacherResponseData::class)]
    public function __invoke(GetClassroomCourseTeacherRequestData $request)
    {
        return GetClassroomCourseTeacherResponseData::from(
            ClassroomCourseTeacher::query()
                ->with(
                    [
                        'courseTeacher',
                    ]
                )
                ->firstWhere(
                    'id',
                    $request->id
                )
        );
    }
}
