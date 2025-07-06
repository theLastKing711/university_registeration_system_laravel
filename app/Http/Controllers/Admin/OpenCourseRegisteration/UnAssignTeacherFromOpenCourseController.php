<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\UnAssignTeacherFromOpenCourse\Request\UnAssignTeacherFromOpenCourseRequestData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\ListQueryParameter;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\OpenCourseRegisteration\Abstract\OpenCourseRegisterationTeacherController;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class UnAssignTeacherFromOpenCourseController extends OpenCourseRegisterationTeacherController
{
    #[OAT\Delete(path: '/admins/opencourseregisterations/{id}/teachers', tags: ['adminsOpenCourseRegisterations'])]
    #[ListQueryParameter('teachers_ids')]
    #[SuccessNoContentResponse]
    public function __invoke(UnAssignTeacherFromOpenCourseRequestData $request)
    {

        CourseTeacher::query()
            ->whereIn(
                'teacher_id',
                $request->teachers_ids
            )
            ->where(
                [
                    'course_id' => $request->id,
                ]
            )
            ->delete();
    }
}
