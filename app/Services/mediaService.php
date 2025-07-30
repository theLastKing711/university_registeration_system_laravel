<?php

namespace App\Services;

use App\Data\Shared\File\UpdateFileData;
use App\Data\Shared\Media\ModelAndMediable;
use App\Enum\FileUploadDirectory;
use App\Facades\CloudUploadService;
use App\Models\Media;
use App\Models\TemporaryUploadedImages;
use Cloudinary;
use Cloudinary\Api\Exception\ApiError;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Traversable;

class mediaService
{
    // public function __construct(private CloudUploadService $cloudUploadService) {}

    /**
     * temporary upload files on clound in specified directory
     *
     * @param  \App\Trait\Uploadable&Model  $model
     * @param  UploadedFile[]|Collection<UploadedFile>  $request_files
     * @param  FileUploadDirectory  $fileUploadDirectorys
     * @return array|Traversable
     *
     * @throws ApiError
     */
    public function temporaryUploadImages(Model $model, Collection $request_files, FileUploadDirectory $fileUploadDirectory)
    {

        $cloud_uploaded_files =
            $request_files
                ->map(function (UploadedFile $request_file) {
                    return CloudUploadService::upload($request_file);
                });

        $temporary_uploaded_images =
            $cloud_uploaded_files
                ->map(function ($cloud_image_resposne) use ($fileUploadDirectory) {

                    $first_eager_response =
                         $cloud_image_resposne['eager'][0];

                    $temporary_uploaded_image = new TemporaryUploadedImages;
                    $temporary_uploaded_image->public_id = $cloud_image_resposne[CloudinaryEngine::PUBLIC_ID];
                    $temporary_uploaded_image->file_name = $cloud_image_resposne[CloudinaryEngine::ORIGINAL_FILENAME];
                    $temporary_uploaded_image->file_url = $cloud_image_resposne[CloudinaryEngine::SECURE_URL];
                    $temporary_uploaded_image->size = $cloud_image_resposne[CloudinaryEngine::BYTES];
                    $temporary_uploaded_image->file_type = $cloud_image_resposne[CloudinaryEngine::RESOURCE_TYPE];
                    $temporary_uploaded_image->collection_name = $fileUploadDirectory->value;
                    $temporary_uploaded_image->thumbnail_url = $first_eager_response[CloudinaryEngine::SECURE_URL];

                    return $temporary_uploaded_image;
                });

        $uploaded_images =
            $model->
                temporaryUploadedImages()
                    ->saveMany($temporary_uploaded_images);

        return $uploaded_images;
    }

    /**
     * Delete all/one/multiple file(s) associated with a particular Model record
     *
     * @param  UpdateFileData[]|Collection<UpdateFileData>  $request_files
     * @return void
     *
     * @throws ApiError
     */
    public function updateMediaForModel(ModelAndMediable $model, array|Collection $request_files)
    {
        /** @var Collection<int, string> $file_to_update_ids */
        $file_to_update_ids = $request_files->pluck('uid');

        /** @var Collection<int, Media> $medias_to_delete */
        $medias_to_delete =
            $model
                ->medially
                ->whereNotIn('id', $file_to_update_ids);

        Log::info('media ids to delete {ids}', ['ids' => $medias_to_delete]);

        $model->detachMedia($medias_to_delete);

        /** @var Collection<int, string> $existing_media_ids */
        $existing_media_ids =
            $model
                ->medially
                ->pluck('id');

        /** @var Collection<int, string> $media_to_add_urls */
        $media_to_add_urls = $request_files->filter(
            fn ($file) => ! $existing_media_ids->contains($file->uid)
        )->pluck('url');

        foreach ($media_to_add_urls as &$media_url) {
            $model->attachRemoteMedia($media_url);
        }
    }

    /**
     * Delete all/one/multiple file(s) associated with a particular Model record
     *
     * @param  int[]|Collection<int, int>  $public_ids
     * @return void
     *
     * @throws ApiError
     */
    public function createMediaForModel(ModelAndMediable $model, array|Collection $public_ids)
    {

        foreach ($public_ids as &$public_id) {

            $cloud_image = Cloudinary::getImage($public_id);

            $cloud_image_url = $cloud_image->toUrl();

            $model->attachRemoteMedia($cloud_image_url);
        }
    }

    /**
     * Delete all/one/multiple file(s) associated with a particular Model record
     */
    public function removeAssociatedMediaForModel(ModelAndMediable $model): void
    {
        $model->detachMedia();
    }
}
