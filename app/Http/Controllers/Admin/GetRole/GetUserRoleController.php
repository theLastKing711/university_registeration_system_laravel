<?php

namespace App\Http\Controllers\Admin\GetRole;

use App\Data\Admin\GetRole\Response\GetUserRoleResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/getroles/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/usersTestPathParameterData',
            ),
        ],
    ),
]
class GetUserRoleController extends Controller
{
    #[OAT\Get(path: '/admins/getroles/{id}', tags: ['adminsGetRoles'])]
    #[SuccessItemResponse(GetUserRoleResponseData::class)]
    public function __invoke()
    {

        $logged_user_role =
            User::query()
                ->firstWhere(
                    'id',
                    Auth::User()->id
                )
                ->roles()
                ->first();

        // return GetUserRoleResponseData::from(
        //     $logged_user_role
        // );

        return new GetUserRoleResponseData(
            $logged_user_role->id,
            $logged_user_role->name,
            true
        );

    }
}
