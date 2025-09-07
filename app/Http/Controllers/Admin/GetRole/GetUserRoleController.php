<?php

namespace App\Http\Controllers\Admin\GetRole;

use App\Data\Admin\GetUserRole\Request\GetUserRoleRequestData;
use App\Data\Admin\GetUserRole\Response\GetUserRoleResponseData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetUserRoleController extends Controller
{
    #[OAT\Get(path: '/admins/role', tags: ['adminsAdmins'])]
    #[JsonRequestBody(GetUserRoleRequestData::class)]
    #[SuccessItemResponse(GetUserRoleResponseData::class)]
    public function __invoke(GetUserRoleRequestData $request)
    {

        $route_array =
            explode(
                '/',
                $request
                    ->resourse
            );

        $role = '';

        $route = '';

        foreach ($route_array as $key => $value) {
            if ($key === 0) {
                $role = $value;
            } else {
                $route = "{$route} {$value}";
            }
        }

        $action =
            $request
                ->action;

        $student_role_or_empty =
            $role === 'students'
            ?
            ' student'
            :
            '';

        $permission =
            "{$action}{$student_role_or_empty}{$route}";

        $logged_user =
            User::query()
                ->firstWhere(
                    'id',
                    Auth::User()->id
                );

        // $is_user_admin
        //     =
        //     $logged_user
        //         ->hasRole(RolesEnum::ADMIN);

        // if ($is_user_admin) {
        //     return new GetUserRoleResponseData(
        //         true
        //     );
        // }

        $user_has_required_permission =
            $logged_user
                ->hasPermissionTo(
                    $permission
                );

        return new GetUserRoleResponseData(
            $user_has_required_permission
        );

    }
}
