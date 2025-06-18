<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\GetCourseTeacherStudents\Response\GetCourseTeacherStudentsRespnseData;
use App\Data\Admin\CourseTeacher\PathParameters\CourseTeacherPathParameterData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/courses/{id}/students',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsCourseTeacherPathParameterData',
            ),
        ],
    ),
]
class GetCourseTeacherStudentsController extends Controller
{
    #[OAT\Get(path: '/admins/courses/{id}/students', tags: ['adminsCourseTeachers'])]
    #[SuccessListResponse(GetCourseTeacherStudentsRespnseData::class)]
    public function __invoke(CourseTeacherPathParameterData $courseTeacherPathData)
    {

        return
            CourseTeacher::query()
                ->with('course.students:id,name')
                ->firstWhere(
                    'id',
                    $courseTeacherPathData->id,
                )
                ->course
                ->students;

    }
}
