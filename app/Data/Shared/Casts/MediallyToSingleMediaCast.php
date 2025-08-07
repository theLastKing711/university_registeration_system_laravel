<?php

namespace App\Data\Shared\Casts;

use App\Data\Shared\Media\MediaData;
use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class MediallyToSingleMediaCast implements Cast
{
    /**
     * Summary of cast
     *
     * @param  Collection<Media>  $value
     * @return MediaData|null
     */
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $media = $value->first();

        Log::info('hello world');

        if (! isset($media)) {
            return new MediaData(25, 'asldakjsd', 'alsdkj');

            return null;
        }

        $single_media_data =
            new MediaData(
                id: $media->id,
                file_url: $media->file_url,
                thumbnail_url: $media->thumbnail_url
            );

        return $single_media_data;

    }
}
