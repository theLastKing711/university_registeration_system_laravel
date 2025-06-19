<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\UpdateStudent\Request\UpdateStudentRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Student\Abstract\StudentController;
use App\Models\User;
use OpenApi\Attributes as OAT;

class UpdateStudentController extends StudentController
{
    #[OAT\Patch(path: '/admins/students/{id}', tags: ['adminsStudents'])]
    #[JsonRequestBody(UpdateStudentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateStudentRequestData $request)
    {

        User::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update([
                'department_id' => $request->department_id,
                'national_id' => $request->national_id,
                'birthdate' => $request->birthdate,
                'enrollment_date' => $request->enrollment_date,
                'graduation_date' => $request->graduation_date,
                'phone_number' => $request->phone_number,
                'name' => $request->name,
                'password' => $request->password,
            ]);

    }
}
