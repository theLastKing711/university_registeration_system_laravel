<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\GetAdmins\Request\GetAdminsRequestData;
use App\Data\Admin\Admin\GetAdmins\Response\GetAdminsResponseData;
use App\Data\Admin\Admin\GetAdmins\Response\GetAdminsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class GetAdminsController extends Controller
{
    #[OAT\Get(path: '/admins/admins', tags: ['adminsAdmins'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetAdminsResponsePaginationResultData::class)]
    public function __invoke(GetAdminsRequestData $request)
    {

        // sleep(4);

        return GetAdminsResponseData::collect(
            User::paginate($request->perPage)
        );
    }
}
