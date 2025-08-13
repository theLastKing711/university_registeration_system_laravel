<?php

namespace App\Http\Controllers\Admin\Classroom;

use App\Data\Admin\Classroom\DeleteClassroom\Request\DeleteClassroomRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Classroom\Abstract\ClassroomController;
use App\Models\Classroom;
use OpenApi\Attributes as OAT;

class DeleteClassroomController extends ClassroomController
{
    #[OAT\Delete(path: '/admins/classrooms/{id}', tags: ['adminsClassrooms'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteClassroomRequestData $request)
    {

        Classroom::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();

    }
}
