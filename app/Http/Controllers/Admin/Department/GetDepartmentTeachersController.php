<?php

namespace App\Http\Controllers\Admin\Department;

use App\Data\Admin\Department\GetDepartmentTeachers\Request\GetDepartmentTeachersRequestData;
use App\Data\Admin\Department\GetDepartmentTeachers\Response\GetDepartmentTeachersResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Department\Abstract\DepartmentTeacherController;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class GetDepartmentTeachersController extends DepartmentTeacherController
{
    #[OAT\Get(path: '/admins/departments/{id}/teachers', tags: ['adminsDepartments'])]
    #[SuccessListResponse(GetDepartmentTeachersResponseData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(GetDepartmentTeachersRequestData $request)
    {

        $department_teachers =
            Teacher::query()
                ->whereRelation(
                    'department',
                    'id',
                    $request->id
                )
                ->select('id', 'name')
                ->get();

        return
            GetDepartmentTeachersResponseData::collect(
                $department_teachers
            );

    }
}
