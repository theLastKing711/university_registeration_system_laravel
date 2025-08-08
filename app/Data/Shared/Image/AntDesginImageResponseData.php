<?php

namespace App\Data\Shared\Image;

use App\Models\TemporaryUploadedImages;
use CloudinaryLabs\CloudinaryLaravel\Model\Media;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

// Between(512, 1024)

#[TypeScript]
#[Oat\Schema(schema: 'AntDesginImageResponseData')]
class AntDesginImageResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public AntDesginImageResponse $response,
        #[OAT\Property]
        public string $uid,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $url,
        #[OAT\Property]
        public string $type,
        #[OAT\Property]
        public int $size,
        #[OAT\Property]
        public ?int $percent = 100,
        #[OAT\Property]
        public ?string $status = 'done',
    ) {}

    public static function fromMedia(Media $media): self
    {

        return new self(
            new AntDesginImageResponse($media->id),
            $media->uid,
            $media->file_name,
            $media->file_url,
            $media->file_type,
            $media->size,
        );
    }

    public static function fromTemporaryUploadedImage(TemporaryUploadedImages $media): self
    {

        return new self(
            new AntDesginImageResponse($media->id),
            $media->uid,
            $media->file_name,
            $media->file_url,
            $media->file_type,
            $media->size,
        );
    }
}
