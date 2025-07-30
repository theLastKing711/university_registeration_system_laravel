<?php

namespace App\Trait;

use App\Enum\FileUploadDirectory;
use App\Interfaces\IUploadable;
use App\Models\TemporaryUploadedImages;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use CloudinaryLabs\CloudinaryLaravel\Model\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * MediaAlly
 *
 * Provides functionality for attaching Cloudinary files to an eloquent model.
 * Whether the model should automatically reload its media relationship after modification.
 *
 * @phpstan-require-implements IUploadable
 *
 * @phpstan-require-extends \Illuminate\Database\Eloquent\Model
 */
trait Uploadable
{
    use MediaAlly;

    /**
     * Summary of temporaryUploadedImages
     *
     * @return MorphMany<TemporaryUploadedImages, $this>|MorphMany<TemporaryUploadedImages, \Eloquent>
     */
    public function temporaryUploadedImages(): MorphMany
    {
        return $this->morphMany(TemporaryUploadedImages::class, 'uploadable');
    }

    /**
     * Summary of temporaryUploadedByCollectionName
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, TemporaryUploadedImages>
     */
    public function temporaryUploadedByCollectionName(FileUploadDirectory $file_upload_directory): Collection
    {

        return
            $this
                ->temporaryUploadedImages()
                ->where(
                    'collection_name',
                    $file_upload_directory
                )
                ->get();

    }
}
