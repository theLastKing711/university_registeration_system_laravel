<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\DeleteOpenCourse\Request\UnRegisterOpenCourseRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\OpenCourseRegisteration\Abstract\OpenCourseRegisterationController;
use App\Models\StudentCourseRegisteration;
use OpenApi\Attributes as OAT;

class UnRegisterOpenCourseController extends OpenCourseRegisterationController
{
    #[OAT\Delete(path: '/admins/course-registerations/{id}', tags: ['studentsOpenCourseRegisterations'])]
    #[SuccessNoContentResponse]
    public function __invoke(UnRegisterOpenCourseRequestData $request)
    {

        StudentCourseRegisteration::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();

    }
}
