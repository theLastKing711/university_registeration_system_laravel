<?php

namespace App\Data\Shared;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class IdData extends Data
{
    public function __construct(
        #[OAT\Property()]
        public int $id,
    ) {}

}
