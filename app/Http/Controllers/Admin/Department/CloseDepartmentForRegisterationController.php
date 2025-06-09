<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\CloseDepartmentForRegisterationData;
use App\Data\Admin\Department\PathParameters\DepartmentIdPathParameterData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Department;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/departments/{id}/closeForRegisteration',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsDepartmentIdPathParameterData',
            ),
        ],
    ),
]
class CloseDepartmentForRegisterationController extends Controller
{
    #[OAT\Patch(path: '/admins/departments/{id}/closeForRegisteration', tags: ['adminsDepartments'])]
    #[JsonRequestBody(CloseDepartmentForRegisterationData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(
        DepartmentIdPathParameterData $patheParameterData,
        // CloseDepartmentForRegisterationData $request
    ) {
        Department::query()
            ->where(
                'id',
                $patheParameterData->id
            )
            ->update([
                'is_course_registeration_open' => false,
            ]);
    }
}
