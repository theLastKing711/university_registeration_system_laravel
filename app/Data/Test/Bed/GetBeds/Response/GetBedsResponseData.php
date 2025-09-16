<?php

namespace App\Data\Test\Bed\GetBeds\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedGetBedsResponseGetBedsResponseData')]
class GetBedsResponseData extends Data
{
    public function __construct(

    ) {
    }
}
