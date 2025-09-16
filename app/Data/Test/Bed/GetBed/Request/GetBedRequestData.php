<?php

namespace App\Data\Test\Bed\GetBed\Request;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;

class GetBedRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'testsGetBedRequestPathParameterData', //the name used in ref
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('tests', 'id')
        ]
        public int $id,
    ) {
    }
}
