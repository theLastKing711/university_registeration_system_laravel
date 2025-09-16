<?php

namespace App\Data\Test\Bed\UpdateBed\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedUpdateBedRequestUpdateBedRequestData')]
class UpdateBedRequestData extends Data
{
    public function __construct(

    ) {}

}
