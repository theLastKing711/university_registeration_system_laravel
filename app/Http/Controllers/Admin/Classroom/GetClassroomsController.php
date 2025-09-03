<?php

namespace App\Http\Controllers\Admin\Classroom;

use App\Data\Admin\Classroom\GetClassrooms\Request\GetClassroomsRequestData;
use App\Data\Admin\Classroom\GetClassrooms\Response\GetClassroomsResponseData;
use App\Data\Admin\Classroom\GetClassrooms\Response\GetClassroomsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use OpenApi\Attributes as OAT;

class GetClassroomsController extends Controller
{
    #[OAT\Get(path: '/admins/classrooms', tags: ['adminsClassrooms'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetClassroomsResponsePaginationResultData::class)]
    public function __invoke(GetClassroomsRequestData $request)
    {
        return GetClassroomsResponseData::collect(
            Classroom::query()
                ->paginate($request->perPage)
        );
    }
}
