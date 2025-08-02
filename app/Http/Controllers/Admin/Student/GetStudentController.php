<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\GetStudent\Request\GetStudentRequestData;
use App\Data\Admin\Student\GetStudent\Response\GetStudentResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Admin\Student\Abstract\StudentController;
use App\Models\User;
use OpenApi\Attributes as OAT;

class GetStudentController extends StudentController
{
    #[OAT\Get(path: '/admins/students/{id}', tags: ['adminsStudents'])]
    #[SuccessItemResponse(GetStudentResponseData::class)]
    public function __invoke(GetStudentRequestData $request)
    {
        // return GetStudentResponseData::from(
        return User::query()
            ->with(
                [
                    'profilePicture',
                ]
            )
            ->firstWhere(
                'id',
                $request->id
            );
        // );
    }
}
