<?php

namespace App\Data\Shared\Image;

use Illuminate\Http\UploadedFile;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

// Between(512, 1024)

#[TypeScript]
#[Oat\Schema(schema: 'AntDesginUploadFile')]
class AntDesginUploadFile extends UploadedFile
{
    public function __construct(
        #[OAT\Property]
        public string $uid,
    ) {}

}
