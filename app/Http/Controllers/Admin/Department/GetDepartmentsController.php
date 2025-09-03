<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\GetDepartment\Request\GetDepartmentRequestData;
use App\Data\Admin\Department\GetDepartments\Response\GetDepartmentsResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Department;
use OpenApi\Attributes as OAT;

class GetDepartmentsController extends Controller
{
    #[OAT\Get(path: '/admins/departments', tags: ['adminsDepartments'])]
    #[SuccessListResponse(GetDepartmentsResponseData::class)]
    public function __invoke(GetDepartmentRequestData $request)
    {
        return
            GetDepartmentsResponseData::collect(
                Department::paginate($request->perPage)
            );

    }
}
