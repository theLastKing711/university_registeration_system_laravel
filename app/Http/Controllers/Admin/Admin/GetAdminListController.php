<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\GetAdminList\Response\GetAdminListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetAdminListController extends Controller
{
    #[OAT\Get(path: '/admins/admins/list', tags: ['adminsAdmins'])]
    #[SuccessListResponse(GetAdminListResponseData::class)]
    public function __invoke()
    {
        return GetAdminListResponseData::collect(
            User::query()
                ->select('id', 'name')
                ->role(RolesEnum::ADMIN)
                // ->where(
                //     'id',
                //     '!=',
                //     Auth::User()->id
                // )
                ->get()
        );
    }
}
