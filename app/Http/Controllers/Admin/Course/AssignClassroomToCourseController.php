<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\AssignClassroomToCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class AssignClassroomToCourseController extends Controller
{
    #[OAT\Post(path: '/admins/courses/assignClassroomToCourse', tags: ['adminsCourses'])]
    #[JsonRequestBody(AssignClassroomToCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignClassroomToCourseRequestData $request)
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
