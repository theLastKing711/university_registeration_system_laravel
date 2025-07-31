<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\DeleteStudentProfilePicture\Request\DeleteStudentProfilePictureRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Facades\MediaService;
use App\Http\Controllers\Admin\Student\Abstract\StudentController;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/students/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/usersTestPathParameterData',
            ),
        ],
    ),
]
class DeleteStudentProfilePictureController extends StudentController
{
    #[OAT\Delete(path: '/admins/students/{id}/profile-picture/{id}', tags: ['adminsStudents'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteStudentProfilePictureRequestData $request)
    {

        MediaService::destroyByMediaId(
            $request->profile_picture_id
        );
    }
}
