<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\CloseDepartmentForRegisteration\Request\CloseDepartmentForRegisterationRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentRegisterationPeriod;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/departments/{id}/close-for-registerations',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/CloseDepartmentForRegisterationPathParameterData',
            ),
        ],
    ),
]
class CloseDepartmentForRegisterationController extends Controller
{
    #[OAT\Patch(path: '/admins/departments/{id}/close-for-registerations', tags: ['adminsDepartments'])]
    #[JsonRequestBody(CloseDepartmentForRegisterationRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(
        CloseDepartmentForRegisterationRequestData $request
    ) {

        DepartmentRegisterationPeriod::query()
            ->where(
                'department_id',
                $request->id
            )
            ->where(
                'year',
                $request->year
            )
            ->where(
                'semester',
                $request->semester
            )
            ->first()
            ->update([
                'is_open_for_students' => false,
            ]);

        // Department::query()
        //     ->where(
        //         'id',
        //         $patheParameterData->id
        //     )
        //     ->update([
        //         'is_course_registeration_open' => false,
        //     ]);
    }
}
