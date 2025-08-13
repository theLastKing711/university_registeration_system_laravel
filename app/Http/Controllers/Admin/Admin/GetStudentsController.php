<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\GetOpenCourseRegisterations\Request\GetOpenCourseRegisterationsRequestData;
use App\Http\Controllers\Controller;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Admin\Admin\GetOpenCourseRegisterations\Response\GetOpenCourseRegisterationsResponsePaginationResultData;
use App\Data\Admin\Admin\GetOpenCourseRegisterations\Response\GetOpenCourseRegisterationsResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use OpenApi\Attributes as OAT;

class GetStudentsController extends Controller
{

    #[OAT\Get(path: '/admins/admins', tags: ['adminsAdmins'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetOpenCourseRegisterationsResponsePaginationResultData::class)]
    public function __invoke(GetOpenCourseRegisterationsRequestData $request)
    {
        return GetOpenCourseRegisterationsResponseData::collect(

        );
    }
}
