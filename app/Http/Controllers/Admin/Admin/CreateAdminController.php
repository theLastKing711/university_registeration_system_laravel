<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\CreateAdmin\Request\CreateAdminRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Admin\AdminCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use OpenApi\Attributes as OAT;

class CreateAdminController extends Controller
{
    #[OAT\Post(path: '/admins/admins', tags: ['adminsAdmins'])]
    #[JsonRequestBody(CreateAdminRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateAdminRequestData $request)
    {

        DB::transaction(function () use ($request) {
            $user = User::query()
                ->create([
                    'name' => $request->name,
                    'password' => $request->password,
                ]);

            $user->assignRole(RolesEnum::ADMIN);

            $admins =
                User::query()
                    ->role(RolesEnum::ADMIN)
                    ->get();

            Notification::sendNow(
                $admins,
                new AdminCreated($user)
            );

        });

        return true;

    }
}
