<?php

namespace App\Http\Controllers\Admin\Image;

use App\Data\Shared\File\UploadFileResponseData;
use App\Data\Shared\Image\AntDesginImageResponseData;
use App\Data\Shared\Image\UploadImageData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Request\FormDataRequestBody;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Facades\MediaService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class UploadImageController extends Controller
{
    #[OAT\Post(path: '/admins/images', tags: ['adminImages'])]
    #[QueryParameter('fileUploadDirectory', 'string')]
    #[FormDataRequestBody(UploadImageData::class)]
    #[SuccessItemResponse(UploadFileResponseData::class, 'Image uploaded successfully')]
    public function __invoke(UploadImageData $request)
    {

        $logged_user =
           Auth::User();

        $temporary_uploaded_image =
            MediaService::temporaryUploadImage(
                $logged_user,
                $request->file,
                $request->fileUploadDirectory,
                ['context' => "uid={$request->uid}"]
            );

        return
            AntDesginImageResponseData::from(
                $temporary_uploaded_image
            );

    }
}
