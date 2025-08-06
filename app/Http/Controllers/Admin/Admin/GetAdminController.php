<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\GetAdmin\Request\GetAdminRequestData;
use App\Data\Admin\Admin\GetAdmin\Response\GetAdminResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Admin\Admin\Abstract\AdminController;
use App\Models\User;
use OpenApi\Attributes as OAT;

class GetAdminController extends AdminController
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
