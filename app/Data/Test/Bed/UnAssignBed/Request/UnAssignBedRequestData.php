<?php

namespace App\Data\Test\Bed\UnAssignBed\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedUnAssignBedRequestUnAssignBedRequestData')]
class UnAssignBedRequestData extends Data
{
    public function __construct(

    ) {}

}
