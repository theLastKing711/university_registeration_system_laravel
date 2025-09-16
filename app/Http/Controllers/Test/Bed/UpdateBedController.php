<?php

namespace App\Http\Controllers\Test\Bed;


use App\Http\Controllers\Controller;

use App\Data\Test\Bed\UpdateBed\Request\UpdateBedRequestData;
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
class UpdateBedController extends Controller
{

    #[OAT\Patch(path: '/tests/beds/{id}', tags: ['testsBeds'])]
    #[JsonRequestBody(UpdateBedRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke( UpdateBedRequestData $request)
    {

    }
}
