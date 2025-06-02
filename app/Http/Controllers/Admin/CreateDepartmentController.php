<?php

namespace App\Http\Controllers\Admin;

use App\Data\Admin\CreateDepartmentRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Department;
use OpenApi\Attributes as OAT;

class CreateDepartmentController extends Controller
{
    #[OAT\Post(path: '/admins/createdepartments', tags: ['adminsCreateDepartments'])]
    #[JsonRequestBody(CreateDepartmentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateDepartmentRequestData $request)
    {

        $department = new Department;

        $department->name = $request->name;

        Department::create(
            $department->toArray()
        );

    }
}
