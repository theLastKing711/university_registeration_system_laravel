<?php

namespace App\Http\Controllers\Admin\Image;

use App\Data\Shared\File\UploadFileData;
use App\Data\Shared\File\UploadFileResponseData;
use App\Data\Shared\Image\UploadImageData;
use App\Data\Shared\Media\MediaData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Request\FormDataRequestBody;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Facades\MediaService;
use App\Http\Controllers\Controller;
use App\Models\TemporaryUploadedImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;

class UploadImageController extends Controller
{
    #[OAT\Post(path: '/admins/images', tags: ['adminImages'])]
    #[QueryParameter('fileUploadDirectory')]
    #[FormDataRequestBody(UploadFileData::class)]
    #[SuccessItemResponse(UploadFileResponseData::class, 'Image uploaded successfully')]
    public function __invoke(UploadImageData $request)
    {

        // Log::info('hello world');

        // $temporaryImage =
        //     TemporaryUploadedImages::factory()
        //         ->schoolFiles()
        //         ->create();

        // return new MediaData(
        //     $temporaryImage->id,
        //     'https://placehold.co/600x400',
        //     'https://placehold.co/600x400'
        // );

        $logged_user =
           Auth::User();

        $temporary_uploaded_image =
            MediaService::temporaryUploadImage(
                $logged_user,
                $request->file,
                $request->fileUploadDirectory
            );

        return
            MediaData::from(
                $temporary_uploaded_image
            );

    }
}
