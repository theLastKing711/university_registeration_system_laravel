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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class mediaService
{
    // public function __construct(private CloudUploadService $cloudUploadService) {}

    public function destroyByMediaId(int $mediaId)
    {

        /** @var Media $media */
        $media =
            Media::query()
                ->firstWhere(
                    'id',
                    $mediaId
                );

        CloudUploadService::destroy($media->file_name);

        $media->delete();

    }

    public function destroyTemporaryImageById(int $id)
    {

        /** @var TemporaryUploadedImages $temporaryUploadedImage */
        $temporaryUploadedImage =
            TemporaryUploadedImages::query()
                ->firstWhere(
                    'id',
                    $id
                );

        CloudUploadService::destroy(
            $temporaryUploadedImage->file_name
        );

        $temporaryUploadedImage
            ->delete();

    }

    /**
     * Summary of destroyTemporaryImagesByIds
     *
     * @param  \Illuminate\Support\Collection<int>  $ids
     * @return void
     */
    public function destroyTemporaryImagesByIds(Collection $tempraryUploaedImagesIds)
    {

        $temporaryUploadedImages =
            TemporaryUploadedImages::query()
                ->whereIn(
                    'id',
                    $tempraryUploaedImagesIds
                )
                ->get();

        $temporaryUploadedImages
            ->each(fn ($image) => CloudUploadService::destroy(
                $image->file_name
            ));

        $temporaryUploadedImages
            ->toQuery()
            ->delete();

    }

    /**
     * temporary upload files on clound in specified directory
     *
     * @param  \App\Trait\Uploadable&Model  $model
     * @param  UploadedFile[]|Collection<UploadedFile>  $request_files
     *
     * @throws ApiError
     */
    public function temporaryUploadImages(Model $model, Collection $request_files, FileUploadDirectory $fileUploadDirectory)
    {

        $temporary_uploaded_images =
            $request_files
                ->map(function (UploadedFile $request_file) use ($fileUploadDirectory) {
                    $cloud_image_resposne = CloudUploadService::upload($request_file);

                    return
                        TemporaryUploadedImages::fromCloudinaryUploadResponse(
                            $cloud_image_resposne,
                            $fileUploadDirectory
                        );

                });

        $uploaded_images =
            $model->
                temporaryUploadedImages()
                    ->saveMany($temporary_uploaded_images);

        return $temporary_uploaded_images;
    }

    /**
     * temporary upload files on clound in specified directory
     *
     * @param  \App\Trait\Uploadable&Model  $model
     *
     * @throws ApiError
     */
    public function temporaryUploadImage(Model $model, UploadedFile $request_file, FileUploadDirectory $fileUploadDirectory, array $options = [])
    {

        $cloud_image_resposne =
            CloudUploadService::upload(
                $request_file,
                $options
            );

        $temporary_uploaded_image =
            TemporaryUploadedImages::fromCloudinaryUploadResponse(
                $cloud_image_resposne,
                $fileUploadDirectory
            );

        Log::info($temporary_uploaded_image);

        $uploaded_images =
            $model->
                temporaryUploadedImages()
                    ->save($temporary_uploaded_image);

        return $temporary_uploaded_image;
    }

    /**
     * temporary upload files on clound in specified directory
     *
     * @param  \App\Trait\Uploadable&Model  $model
     *
     * @throws ApiError
     */
    public function temporaryUploadAntDesginImage(Model $model, UploadedFile $request_file, FileUploadDirectory $fileUploadDirectory, array $options = [])
    {

        $cloud_image_resposne =
            CloudUploadService::upload(
                $request_file,
                $options
            );

        $temporary_uploaded_image =
            TemporaryUploadedImages::fromCloudinaryUploadResponse(
                $cloud_image_resposne,
                $fileUploadDirectory
            );

        $uploaded_images =
            $model->
                temporaryUploadedImages()
                    ->save($temporary_uploaded_image);

        return $temporary_uploaded_image;
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
