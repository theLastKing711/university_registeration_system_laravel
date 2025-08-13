<?php

namespace App\Http\Controllers\Admin\Classroom;

use App\Data\Admin\Classroom\UpdateClassroom\Request\UpdateClassroomRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Classroom\Abstract\ClassroomController;
use App\Models\Classroom;
use OpenApi\Attributes as OAT;

class UpdateClassroomController extends ClassroomController
{
    #[OAT\Patch(path: '/admins/classrooms/{id}', tags: ['adminsClassrooms'])]
    #[JsonRequestBody(UpdateClassroomRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateClassroomRequestData $request)
    {

        Classroom::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update([
                'name' => $request->name,
            ]);

    }
}
