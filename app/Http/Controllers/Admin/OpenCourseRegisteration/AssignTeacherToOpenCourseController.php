<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\AssignTeacherToCourse\Request\AssignTeacherToCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\OpenCourseRegisteration\Abstract\OpenCourseRegisterationTeacherController;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class AssignTeacherToOpenCourseController extends OpenCourseRegisterationTeacherController
{
    #[OAT\Post(path: '/admins/open-course-registerations/{id}/teachers', tags: ['adminsOpenCourseRegisterations'])]
    #[JsonRequestBody(AssignTeacherToCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignTeacherToCourseRequestData $request)
    {

        OpenCourseRegisteration::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->teachers()
            ->attach(
                [$request->teacher_id],
                ['is_main_teacher' => $request->is_main_teacher]
            );

    }
}
