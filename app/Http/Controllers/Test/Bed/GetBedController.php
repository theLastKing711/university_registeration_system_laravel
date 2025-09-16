<?php

namespace App\Http\Controllers\Test\Bed;

use App\Http\Controllers\Controller;

use App\Data\Test\Bed\GetBed\Request\GetBedRequestData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use OpenApi\Attributes as OAT;


class GetBedController extends Controller
{

    #[OAT\Get(path: '/tests/beds/{id}', tags: ['testsBeds'])]
    #[SuccessItemResponse(GetBedRequestData::class)]
    public function __invoke()
    {
        return GetBedRequestData::from(
            
        );
    }
}
