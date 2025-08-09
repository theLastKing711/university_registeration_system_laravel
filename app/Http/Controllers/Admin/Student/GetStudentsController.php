<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\GetStudents\Request\GetStudentsRequestData;
use App\Data\Admin\Student\GetStudents\Response\GetStudentsResponseData;
use App\Data\Admin\Student\GetStudents\Response\GetStudentsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Enum\Auth\RolesEnum;
use App\Enum\SortDirection;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class GetStudentsController extends Controller
{
    #[OAT\Get(path: '/admins/students', tags: ['adminsStudents'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[QueryParameter('query')]
    #[QueryParameter('department_id', 'integer')]
    #[QueryParameter('sort')]
    #[QueryParameter('dir', SortDirection::class)]
    #[QueryParameter('enrollment_year')]

    #[SuccessItemResponse(GetStudentsResponsePaginationResultData::class)]
    public function __invoke(GetStudentsRequestData $request)
    {
        return GetStudentsResponseData::collect(
            User::query()
                ->withAggregate('department', 'name')
                ->when(
                    $request->enrollment_year,
                    fn ($query) => $query
                        ->whereYear('enrollment_date', $request->enrollment_year)
                )
                ->sortByColumn($request->sort, $request->dir)
                ->searchColumns(
                    $request->query,
                    [
                        'name',
                        'national_id',
                        'phone_number',
                    ]
                )
                ->searchExact($request->department_id, 'department_id')

                ->role(RolesEnum::STUDENT)
                ->paginate($request->perPage)
        );
    }
}
