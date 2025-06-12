<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\AdminIdsData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\ListQueryParameter;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class DeleteAdminController extends Controller
{
    #[OAT\Delete(path: '/admins/admins', tags: ['adminsAdmins'])]
    #[ListQueryParameter]
    #[SuccessNoContentResponse]
    public function __invoke(AdminIdsData $request)
    {
        User::query()
            ->whereIn(
                'id',
                $request->ids
            )
            ->delete();
    }
}
