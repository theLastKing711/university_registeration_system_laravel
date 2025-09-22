<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisteration\Request\GetOpenCourseRegisterationRequestData;
use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisteration\Response\GetOpenCourseRegisterationResposneData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Admin\OpenCourseRegisteration\Abstract\OpenCourseRegisterationController;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class GetOpenCourseRegisterationController extends OpenCourseRegisterationController
{
    #[OAT\Get(path: '/admins/opencourseregisterations/{id}', tags: ['adminsOpenCourseRegisterations'])]
    #[SuccessItemResponse(GetOpenCourseRegisterationResposneData::class)]
    public function __invoke(GetOpenCourseRegisterationRequestData $request)
    {
        return GetOpenCourseRegisterationResposneData::from(
            OpenCourseRegisteration::query()
                ->with('courseTeachers')
                ->firstWhereId(
                    $request->id
                )
        );
    }
}
