<?php

namespace App\Http\Controllers\Test\Bed;

use App\Data\Test\Bed\FetchBeds\Request\FetchBedsRequestData;
use App\Http\Controllers\Controller;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Test\Bed\FetchBeds\Response\FetchBedsResponsePaginationResultData;
use App\Data\Test\Bed\FetchBeds\Response\FetchBedsResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use OpenApi\Attributes as OAT;

class FetchBedsController extends Controller
{

    #[OAT\Get(path: '/tests/beds', tags: ['testsBeds'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(FetchBedsResponsePaginationResultData::class)]
    public function __invoke(FetchBedsRequestData $request)
    {
        return FetchBedsResponseData::collect(

        );
    }
}
