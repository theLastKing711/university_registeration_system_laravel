<?php

namespace App\Http\Controllers\Admin\ClassroomCourseTeacher;

use App\Data\Admin\ClassroomCourseTeacher\GetClassroomCourseTeachers\Request\GetClassroomCourseTeachersRequestData;
use App\Data\Admin\ClassroomCourseTeacher\GetClassroomCourseTeachers\Response\GetClassroomCourseTeachersResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\ClassroomCourseTeacher;
use OpenApi\Attributes as OAT;

class GetClassroomCourseTeachersController extends Controller
{
    #[OAT\Get(path: '/admins/classroomcourseteachers', tags: ['adminsClassroomCourseTeachers'])]
    #[SuccessListResponse(GetClassroomCourseTeachersResponseData::class)]
    public function __invoke(GetClassroomCourseTeachersRequestData $request)
    {
        return GetClassroomCourseTeachersResponseData::collect(
            ClassroomCourseTeacher::query()
                // ->withAggregate('courseTeacher.course', 'name')
                // ->withAggregate('courseTeacher.course', 'id')
                ->with([
                    'courseTeacher' => [
                        'course.course',
                        'teacher',
                    ],
                ])
                ->paginate()
        );
    }
}
