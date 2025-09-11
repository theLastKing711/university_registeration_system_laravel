<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\UpdateTeacher\Request\UpdateTeacherRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Events\Admin\TeacherUpdated;
use App\Http\Controllers\Admin\Teacher\Abstract\TeacherController;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class UpdateTeacherController extends TeacherController
{
    #[OAT\Patch(path: '/admins/teachers/{id}', tags: ['adminsTeachers'])]
    #[JsonRequestBody(UpdateTeacherRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateTeacherRequestData $request)
    {

        $teacher =
           Teacher::query()
               ->firstWhere(
                   'id',
                   $request->id
               );

        $teacher
            ->update(
                [
                    'department_id' => $request->department_id,
                    'name' => $request->name,
                ]
            );

        TeacherUpdated::dispatch(
            $teacher->fresh()
        );

    }
}
