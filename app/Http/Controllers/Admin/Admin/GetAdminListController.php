<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetAdminListController extends Controller
{
    #[OAT\Get(path: '/admins/admins/list', tags: ['adminsAdmins'])]
    public function __invoke()
    {

        User::query()
            ->role(RolesEnum::ADMIN)
            ->where(
                'id',
                '!=',
                Auth::User()->id
            )
            ->get();

    }
}
