<?php

namespace App\Data\Test\Bed\CreateBed\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedCreateBedRequestCreateBedRequestData')]
class CreateBedRequestData extends Data
{
    public function __construct(

    ) {}

}
