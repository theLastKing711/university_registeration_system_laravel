<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetCourseStudentsRespnseData;
use App\Data\Admin\Course\PathParameters\CourseTeacherPathParameterData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class GetCourseStudentsController extends Controller
{
    #[
        OAT\PathItem(
            path: '/admins/courses/getCourseStudents/{id}',
            parameters: [
                new OAT\PathParameter(
                    ref: '#/components/parameters/adminsCourseTeacherPathParameterData',
                ),
            ],
        ),
    ]
    #[OAT\Get(path: '/admins/courses/getCourseStudents', tags: ['adminsCourses'])]
    #[SuccessListResponse(GetCourseStudentsRespnseData::class)]
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
