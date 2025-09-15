<?php

namespace App\Http\Controllers\Test\Bed;

use App\Http\Controllers\Controller;
use App\Data\Test\Bed\UnAssignBed\Request\UnAssignBedRequestData;
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
class UnAssignBedController extends Controller
{

    #[OAT\Delete(path: '/tests/beds/{id}', tags: ['testsBeds'])]
    #[SuccessNoContentResponse]
    public function __invoke(UnAssignBedRequestData $request)
    {

    }
}
