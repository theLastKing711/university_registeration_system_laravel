<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\UpdateStudentProfilePicture\Response\UpdateStudentProfilePictureResponseData;
use App\Data\Shared\Swagger\Request\FormDataRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Student\Abstract\StudentController;
use OpenApi\Attributes as OAT;

class UpdateStudentProfilePictureController extends StudentController
{
    #[OAT\Patch(path: '/admins/students/{id}', tags: ['adminsStudents'])]
    #[FormDataRequestBody(UpdateStudentProfilePictureResponseData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateStudentProfilePictureResponseData $request) {}
}
