<?php

namespace App\Data\Test\Bed\FetchBeds\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedFetchBedsResponseFetchBedsResponseData')]
class FetchBedsResponseData extends Data
{
    public function __construct(

    ) {
    }
}
