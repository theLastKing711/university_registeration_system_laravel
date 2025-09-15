<?php

namespace App\Data\Test\Bed\patchBed\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedpatchBedRequestpatchBedRequestData')]
class patchBedRequestData extends Data
{
    public function __construct(

    ) {}

}
