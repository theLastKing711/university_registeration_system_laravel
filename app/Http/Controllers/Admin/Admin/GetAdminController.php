<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\GetAdmin\Request\GetAdminRequestData;
use App\Data\Admin\Admin\GetAdmin\Response\GetAdminResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/admins/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsGetAdminRequestData',
            ),
        ],
    ),
]
class GetAdminController extends Controller
{
    #[OAT\Get(path: '/admins/admins/{id}', tags: ['adminsAdmins'])]
    #[SuccessItemResponse(GetAdminResponseData::class)]
    public function __invoke(GetAdminRequestData $request)
    {
        return GetAdminResponseData::from(
            User::query()
                ->firstWhere(
                    'id',
                    $request->id
                )
        );
    }
}
