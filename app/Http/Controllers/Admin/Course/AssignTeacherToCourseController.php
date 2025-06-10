<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\AssignTeacherToCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class AssignTeacherToCourseController extends Controller
{
    #[OAT\Post(path: '/admins/courses/assignCourseToTeacher', tags: ['adminsCourses'])]
    #[JsonRequestBody(AssignTeacherToCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignTeacherToCourseRequestData $request)
    {

        OpenCourseRegisteration::query()
            ->firstWhere(
                'id',
                $request->course_id
            )
            ->teachers()
            ->attach(
                [$request->teacher_id],
                ['is_main_teacher' => $request->is_main_teacher]
            );

    }
}
