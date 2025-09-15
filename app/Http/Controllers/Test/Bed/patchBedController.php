<?php

namespace App\Http\Controllers\Test\Bed;


use App\Http\Controllers\Controller;

use App\Data\Test\Bed\patchBed\Request\patchBedRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/tests/beds/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/usersTestPathParameterData',
            ),
        ],
    ),
]
class patchBedController extends Controller
{

    #[OAT\Patch(path: '/tests/beds/{id}', tags: ['testsBeds'])]
    #[JsonRequestBody(patchBedRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke( patchBedRequestData $request)
    {

    }
}
