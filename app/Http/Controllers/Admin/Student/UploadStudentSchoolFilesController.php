<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\UploadStudentSchoolFiles\Request\UploadStudentSchoolFilesRequestData;
use App\Data\Shared\Swagger\Request\FormDataRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Enum\FileUploadDirectory;
use App\Facades\MediaService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class UploadStudentSchoolFilesController extends Controller
{
    #[OAT\Post(path: '/admins/students/school-files', tags: ['adminsStudents'])]
    #[FormDataRequestBody(UploadStudentSchoolFilesRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UploadStudentSchoolFilesRequestData $request)
    {

        $logged_user =
            Auth::User();

        MediaService::temporaryUploadImages(
            $logged_user,
            $request->files,
            FileUploadDirectory::SCHOOL_FILES
        );

    }
}
