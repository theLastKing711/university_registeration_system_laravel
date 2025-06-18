<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\AssignTeacherToCourse\Request\AssignTeacherToCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class AssignTeacherToOpenCourseController extends Controller
{
    #[OAT\Post(path: '/admins/open-course-registerations/teachers', tags: ['adminsOpenCourseRegisterations'])]
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
