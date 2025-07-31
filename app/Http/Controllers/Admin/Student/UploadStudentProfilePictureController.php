<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\UploadStudentProfile\Request\UploadStudentProfilePictureRequestData;
use App\Data\Shared\Media\MediaData;
use App\Data\Shared\Swagger\Request\FormDataRequestBody;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Enum\FileUploadDirectory;
use App\Facades\MediaService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class UploadStudentProfilePictureController extends Controller
{
    #[OAT\Post(path: '/admins/students/profile-picture', tags: ['adminsStudents'])]
    #[FormDataRequestBody(UploadStudentProfilePictureRequestData::class)]
    #[SuccessItemResponse(MediaData::class)]
    public function __invoke(UploadStudentProfilePictureRequestData $request)
    {

        $logged_user =
            Auth::User();

        $temporary_uploaded_images =
            MediaService::temporaryUploadImages(
                $logged_user,
                collect([$request->file]),
                FileUploadDirectory::USER_PROFILE_PICTURE
            );

        return
            MediaData::from(
                $temporary_uploaded_images
                    ->first()
            );

    }
}
