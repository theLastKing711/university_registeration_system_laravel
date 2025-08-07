<?php

namespace App\Data\Shared\Image;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

// Between(512, 1024)

#[TypeScript]
#[Oat\Schema(schema: 'AntDesginImageResponse')]
class AntDesginImageResponse extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $id,
    ) {}

}
