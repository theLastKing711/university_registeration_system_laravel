<?php

namespace App\Data\Shared\File;

use App\Data\Shared\Swagger\Property\FileProperty;
use Illuminate\Http\UploadedFile;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class UploadFileData extends Data
{
    public function __construct(
        #[FileProperty]
        public UploadedFile $file,
    ) {}

}
