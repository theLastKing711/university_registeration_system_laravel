<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\UpdateAdmin\Request\UpdateAdminRequestData;
use App\Data\Admin\Admin\UpdateAdmin\Response\UpdateAdminResponseData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/admins/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsUpdateAdminRequestData',
            ),
        ],
    ),
]
class UpdateAdminController extends Controller
{
    #[OAT\Patch(path: '/admins/admins/{id}', tags: ['adminsAdmins'])]
    #[JsonRequestBody(UpdateAdminResponseData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateAdminRequestData $request)
    {

        $user =
            User::query()
                ->firstWhere(
                    'id',
                    $request->id
                );

        if (isset($user->password)) {
            $user->update([
                'name' => $request->name,
                'password' => $request->password,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
            ]);
        }
    }
}
