<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\DeleteStudent\Request\DeleteStudentRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Student\Abstract\StudentController;
use App\Models\User;
use OpenApi\Attributes as OAT;

class DeleteStudentController extends StudentController
{
    #[OAT\Delete(path: '/admins/students/{id}', tags: ['adminsStudents'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteStudentRequestData $request)
    {

        User::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();

    }
}
