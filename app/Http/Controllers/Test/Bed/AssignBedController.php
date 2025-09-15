<?php

namespace App\Http\Controllers\Test\Bed;


use App\Http\Controllers\Controller;
use App\Data\Test\Bed\AssignBed\Request\AssignBedRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use OpenApi\Attributes as OAT;

class AssignBedController extends Controller
{

    #[OAT\Post(path: '/tests/beds', tags: ['testsBeds'])]
    #[JsonRequestBody(AssignBedRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignBedRequestData $request)
    {

    }
}
