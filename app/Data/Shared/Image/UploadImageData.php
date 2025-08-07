<?php

namespace App\Data\Shared\Image;

use App\Data\Shared\Swagger\Property\FileProperty;
use App\Enum\FileUploadDirectory;
use Illuminate\Http\UploadedFile;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

// Between(512, 1024)

#[TypeScript]
#[Oat\Schema(schema: 'uploadImageData')]
class UploadImageData extends Data
{
    public function __construct(
        #[
            FileProperty,
            Image,
        ]
        public UploadedFile $file,
        #[OAT\Property]
        public string $uid,
        public FileUploadDirectory $fileUploadDirectory,
    ) {}
}
