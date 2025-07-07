<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\DeleteTeacher\Request\DeleteTeacherRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Teacher\Abstract\TeacherController;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class DeleteTeacherController extends TeacherController
{
    #[OAT\Delete(path: '/admins/teachers/{id}', tags: ['adminsTeachers'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteTeacherRequestData $request)
    {
        Teacher::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();
    }
}
