<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\RegisterStudentRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class RegisterStudentController extends Controller
{
    #[OAT\Post(path: '/admins/students', tags: ['adminsStudents'])]
    #[JsonRequestBody(RegisterStudentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(RegisterStudentRequestData $request)
    {

        $student = new User;

        $student->department_id = $request->department_id;
        $student->national_id = $request->national_id;
        $student->birthdate = $request->birthdate;
        $student->enrollment_date = $request->enrollment_date;
        $student->phone_number = $request->phone_number;
        $student->name = $request->name;
        $student->password = $request->password;

        $student->save();

    }
}
