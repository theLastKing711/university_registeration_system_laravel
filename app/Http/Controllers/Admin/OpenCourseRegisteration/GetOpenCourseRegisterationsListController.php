<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationsList\Request\GetOpenCourseRegisterationsListRequestData;
use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationsList\Response\GetOpenCourseRegisterationsListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class GetOpenCourseRegisterationsListController extends Controller
{
    #[OAT\Get(path: '/admins/opencourseregisterations', tags: ['adminsOpenCourseRegisterations'])]
    #[SuccessListResponse(GetOpenCourseRegisterationsListResponseData::class)]
    public function __invoke(GetOpenCourseRegisterationsListRequestData $request)
    {
        return GetOpenCourseRegisterationsListResponseData::collect(
            OpenCourseRegisteration::query()
                ->FilterByDepartmentAndAcademicYearSemesterId($request->department_id, $request->academic_year_semester_id)
                ->select([
                    'id',
                    'course_id',
                ])
                ->with(
                    [
                        'course:id,name',
                    ]
                )
                ->get()
        );
    }
}
