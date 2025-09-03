<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\GetDepartment\Request\GetDepartmentRequestData;
use App\Data\Admin\Department\GetDepartment\Response\GetDepartmentResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Admin\Department\Abstract\DepartmentController;
use App\Models\Department;
use OpenApi\Attributes as OAT;

class GetDepartmentController extends DepartmentController
{
    #[OAT\Get(path: '/admins/departments/{id}', tags: ['adminsDepartments'])]
    #[SuccessItemResponse(GetDepartmentResponseData::class)]
    public function __invoke(GetDepartmentRequestData $request)
    {
        return GetDepartmentResponseData::from(
            Department::query()
                ->firstWhereId(
                    $request->id
                )
        );
    }
}
