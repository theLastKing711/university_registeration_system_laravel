<?php

namespace App\Trait;

use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use CloudinaryLabs\CloudinaryLaravel\Model\Media;
use Illuminate\Support\Collection;

/**
 * MediaAlly
 *
 * Provides functionality for attaching Cloudinary files to an eloquent model.
 * Whether the model should automatically reload its media relationship after modification.
 */
trait CustomMediaAlly
{
    use MediaAlly;

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param  Collection<int>  $medias_ids_to_add
     * @param  Collection<int>  $medias_ids_to_delete
     * @param  array  $options
     **/
    public function syncMedia(Collection $medias_ids_to_add, Collection $media_ids_to_delete, $options = [])
    {
        $this->detachMedia($media_ids_to_delete);

        $this->attachMedia($medias_ids_to_add, $options);
    }
}
