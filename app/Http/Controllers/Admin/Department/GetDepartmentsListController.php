<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\GetDepartmentsList\Response\GetDepartmentsListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Department;
use OpenApi\Attributes as OAT;

class GetDepartmentsListController extends Controller
{
    #[OAT\Get(path: '/admins/departments/list', tags: ['adminsDepartments'])]
    #[SuccessListResponse(GetDepartmentsListResponseData::class)]
    public function __invoke()
    {
        return
            GetDepartmentsListResponseData::collect(
                Department::all()
            );

    }
}
