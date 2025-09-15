<?php

namespace App\Data\Test\Bed\AssignBed\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedAssignBedRequestAssignBedRequestData')]
class AssignBedRequestData extends Data
{
    public function __construct(

    ) {}

}
