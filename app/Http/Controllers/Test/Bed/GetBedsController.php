<?php

namespace App\Http\Controllers\Test\Bed;

use App\Data\Test\Bed\GetBeds\Request\GetBedsRequestData;
use App\Http\Controllers\Controller;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Test\Bed\GetBeds\Response\GetBedsResponsePaginationResultData;
use App\Data\Test\Bed\GetBeds\Response\GetBedsResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use OpenApi\Attributes as OAT;

class GetBedsController extends Controller
{

    #[OAT\Get(path: '/tests/beds', tags: ['testsBeds'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetBedsResponsePaginationResultData::class)]
    public function __invoke(GetBedsRequestData $request)
    {
        return GetBedsResponseData::collect(

        );
    }
}
