<?php

namespace App\Http\Controllers\Test\Bed;


use App\Http\Controllers\Controller;
use App\Data\Test\Bed\CreateBed\Request\CreateBedRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use OpenApi\Attributes as OAT;

class CreateBedController extends Controller
{

    #[OAT\Post(path: '/tests/beds', tags: ['testsBeds'])]
    #[JsonRequestBody(CreateBedRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateBedRequestData $request)
    {

    }
}
