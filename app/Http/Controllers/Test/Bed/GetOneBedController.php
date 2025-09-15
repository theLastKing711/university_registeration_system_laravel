<?php

namespace App\Http\Controllers\Test\Bed;

use App\Http\Controllers\Controller;

use App\Data\Test\Bed\GetOneBed\Request\GetOneBedRequestData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
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
class GetOneBedController extends Controller
{

    #[OAT\Get(path: '/tests/beds/{id}', tags: ['testsBeds'])]
    #[SuccessItemResponse(GetOneBedRequestData::class)]
    public function __invoke()
    {
        return GetOneBedRequestData::from(
            
        );
    }
}
