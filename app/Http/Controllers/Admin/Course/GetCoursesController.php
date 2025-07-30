<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetCourses\Request\GetCoursesRequestData;
use App\Data\Admin\Course\GetCourses\Response\GetCoursesResponseData;
use App\Data\Admin\Course\GetCourses\Response\GetCoursesResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\UsdCurrencyExchangeRate\UsdCurrencyExchangeRateService;
use OpenApi\Attributes as OAT;

class GetCoursesController extends Controller
{
    #[OAT\Get(path: '/admins/courses', tags: ['adminsCourses'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[QueryParameter('department_id', 'integer')]
    #[SuccessItemResponse(GetCoursesResponsePaginationResultData::class)]
    public function __invoke(GetCoursesRequestData $request, UsdCurrencyExchangeRateService $usdCurrencyExchangeRateService)
    {
        $courses =
            Course::query()
                ->where(
                    'department_id',
                    $request->department_id
                )
                ->paginate();

        return
            GetCoursesResponseData::collect(
                $courses
            );
    }
}
