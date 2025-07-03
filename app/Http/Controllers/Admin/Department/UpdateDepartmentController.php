<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\UpdateDepartment\Request\UpdateDepartmentRequestData;
use App\Data\Admin\Department\UpdateDepartment\Response\UpdateDepartmentResponseData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Department\Abstract\DepartmentController;
use App\Models\Department;
use OpenApi\Attributes as OAT;

class UpdateDepartmentController extends DepartmentController
{
    #[OAT\Patch(path: '/admins/departments/{id}', tags: ['adminsDepartments'])]
    #[JsonRequestBody(UpdateDepartmentResponseData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateDepartmentRequestData $request)
    {

        Department::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update([
                'name' => $request->name,
            ]);

    }
}
