<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\CreateDepartment\Request\CreateDepartmentRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Department;
use OpenApi\Attributes as OAT;

class CreateDepartmentController extends Controller
{
    #[OAT\Post(path: '/admins/departments', tags: ['adminsDepartments'])]
    #[JsonRequestBody(CreateDepartmentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateDepartmentRequestData $request)
    {

        Department::query()
            ->create([
                'name' => $request->name,
            ]);

    }
}
