<?php

namespace App\Data\Test\Bed\DeleteBed\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'TestBedDeleteBedRequestDeleteBedRequestData')]
class DeleteBedRequestData extends Data
{
    public function __construct(

    ) {}

}
