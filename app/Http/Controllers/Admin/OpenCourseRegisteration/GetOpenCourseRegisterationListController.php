<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationList\Request\GetOpenCourseRegisterationListRequestData;
use App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationList\Response\GetOpenCourseRegisterationListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class GetOpenCourseRegisterationListController extends Controller
{
    #[OAT\Get(path: '/admins/opencourseregisterations', tags: ['adminsOpenCourseRegisterations'])]
    #[SuccessListResponse(GetOpenCourseRegisterationListResponseData::class)]
    public function __invoke(GetOpenCourseRegisterationListRequestData $request)
    {
        return GetOpenCourseRegisterationListResponseData::collect(
            OpenCourseRegisteration::query()
                ->FilterByDepartmentAndAcademicYearSemesterId($request->department_id, $request->academic_year_semester_id)
                ->get()
        );
    }
}
