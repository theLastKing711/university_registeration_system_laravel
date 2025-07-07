<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\GetTeachersPaginated\Request\GetTeachersPaginatedRequestData;
use App\Data\Admin\Teacher\GetTeachersPaginated\Response\GetTeachersPaginatedResponseData;
use App\Data\Admin\Teacher\GetTeachersPaginated\Response\GetTeachersPaginatedResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class GetTeachersPaginatedController extends Controller
{
    #[OAT\Get(path: '/admins/teachers/paginated', tags: ['adminsTeachers'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetTeachersPaginatedResponsePaginationResultData::class)]
    public function __invoke(GetTeachersPaginatedRequestData $request)
    {
        return GetTeachersPaginatedResponseData::collect(
            Teacher::query()
                ->paginate($request->perPage)
        );
    }
}
