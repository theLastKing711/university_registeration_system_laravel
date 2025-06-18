<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\DeleteDepartment\Request\DeleteDepartmentRequestData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\ListQueryParameter;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Department;
use OpenApi\Attributes as OAT;

class DeleteDepartmentController extends Controller
{
    #[OAT\Delete(path: '/admins/departments', tags: ['adminsDepartments'])]
    #[ListQueryParameter]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteDepartmentRequestData $request)
    {

        Department::query()
            ->whereIn(
                'id',
                $request
                    ->ids
            )
            ->delete();

    }
}
