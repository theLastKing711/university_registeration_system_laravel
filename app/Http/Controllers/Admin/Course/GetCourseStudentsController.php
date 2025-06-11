<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetCourseStudentsRespnseData;
use App\Data\Admin\Course\PathParameters\CourseTeacherPathParameterData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/courses/getCourseStudents/{course_teacher_id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsCourseTeacherPathParameterData',
            ),
        ],
    ),
]
class GetCourseStudentsController extends Controller
{
    #[OAT\Get(path: '/admins/courses/getCourseStudents/{course_teacher_id}', tags: ['adminsCourses'])]
    #[SuccessListResponse(GetCourseStudentsRespnseData::class)]
    public function __invoke(CourseTeacherPathParameterData $courseTeacherPathData)
    {

        return
            CourseTeacher::query()
                ->with('course.students:id,name')
                ->firstWhere(
                    'id',
                    $courseTeacherPathData->course_teacher_id,
                )
                ->course
                ->students;

    }
}
