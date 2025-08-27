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
                ->with([
                    'courseTeacher' => [
                        'course.course',
                        'teacher',
                    ],
                ])
                ->when(
                    $request->academic_year_semester_id,
                    fn ($query) => $query
                        ->orWhereRelation(
                            'courseTeacher.course',
                            'academic_year_semester_id',
                            $request->academic_year_semester_id
                        )
                )
                ->when(
                    $request->department_id,
                    fn ($query) => $query
                        ->whereRelation(
                            'courseTeacher.course.course',
                            'department_id',
                            $request->department_id
                        )
                )
                ->paginate()
        );
    }
}
