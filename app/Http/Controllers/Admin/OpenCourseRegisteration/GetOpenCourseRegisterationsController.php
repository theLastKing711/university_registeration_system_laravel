<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterations\Request\GetOpenCourseRegisterationsRequestData;
use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterations\Response\GetOpenCourseRegisterationsResponseData;
use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterations\Response\GetOpenCourseRegisterationsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class GetOpenCourseRegisterationsController extends Controller
{
    #[OAT\Get(path: '/admins/opencourseregisterations', tags: ['adminsOpenCourseRegisterations'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[QueryParameter('department_Id', 'integer')]
    #[QueryParameter('academic_year_semester_id', 'integer')]

    #[SuccessItemResponse(GetOpenCourseRegisterationsResponsePaginationResultData::class)]
    public function __invoke(GetOpenCourseRegisterationsRequestData $request)
    {
        return GetOpenCourseRegisterationsResponseData::collect(
            OpenCourseRegisteration::query()
                ->with(
                    [
                        'academicYearSemester',
                        'course',
                    ]
                )
                ->paginate()
        );
    }
}
