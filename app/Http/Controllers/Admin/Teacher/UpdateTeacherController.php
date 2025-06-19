<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\UpdateTeacher\Request\UpdateTeacherRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/teachers/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsUpdateTeacherPathParameter',
            ),
        ],
    ),
]
class UpdateTeacherController extends Controller
{
    #[OAT\Patch(path: '/admins/teachers/{id}', tags: ['adminsTeachers'])]
    #[JsonRequestBody(UpdateTeacherRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateTeacherRequestData $request)
    {

        Teacher::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update(
                [
                    'department_id' => $request->department_id,
                    'name' => $request->name,
                ]
            );

    }
}
