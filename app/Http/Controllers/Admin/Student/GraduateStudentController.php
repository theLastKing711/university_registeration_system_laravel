<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\GraduateStudent\Request\GraduateStudentRequestData;
use App\Data\Admin\Student\PathParameters\StudentIdPathParameterData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/students/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsStudentIdPathParameterData',
            ),
        ],
    ),
]

class GraduateStudentController extends Controller
{
    #[OAT\Patch(path: '/admins/students/{id}/graduation', tags: ['adminsStudents'])]
    #[JsonRequestBody(GraduateStudentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(StudentIdPathParameterData $studentIdPathParameterData, GraduateStudentRequestData $request)
    {

        User::query()
            ->where('id', $studentIdPathParameterData->id)
            ->update([
                'graduation_date' => $request->graduation_date,
            ]);

    }
}
