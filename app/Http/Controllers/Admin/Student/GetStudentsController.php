<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\GetStudents\Request\GetStudentsRequestData;
use App\Data\Admin\Student\GetStudents\Response\GetStudentsResponseData;
use App\Data\Admin\Student\GetStudents\Response\GetStudentsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class GetStudentsController extends Controller
{
    #[OAT\Get(path: '/admins/students', tags: ['adminsStudents'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetStudentsResponsePaginationResultData::class)]
    public function __invoke(GetStudentsRequestData $request)
    {
        return GetStudentsResponseData::collect(
            User::query()
                ->role(RolesEnum::STUDENT)
                ->paginate($request->perPage)
        );
    }
}
