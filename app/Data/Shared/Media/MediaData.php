<?php

namespace App\Data\Shared\Media;

use App\Models\Media as ModelsMedia;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class MediaData extends Data
{
    public function __construct(
        #[OAT\Property()]
        public string $id,
        #[OAT\Property]
        public string $file_name,
        #[OAT\Property()]
        public string $file_url,
        #[OAT\Property]
        public ?string $thumbnail_url,
    ) {}

    public static function fromModel(?ModelsMedia $media): self
    {

        Log::info($media);

        return new self(
            $media->id,
            $media->file_name,
            file_url: $media->file_url,
            thumbnail_url: $media->thumbnail_url
        );
    }
}
