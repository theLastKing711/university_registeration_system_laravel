<?php

namespace App\Data\Test\Bed\GetOneBed\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedGetOneBedRequestGetOneBedRequestData')]
class GetOneBedRequestData extends Data
{
    public function __construct(

    ) {}

}
