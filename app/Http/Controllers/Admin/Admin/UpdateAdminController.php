<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\UpdateAdmin\Request\UpdateAdminRequestData;
use App\Data\Admin\Admin\UpdateAdmin\Response\UpdateAdminResponseData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Admin\Abstract\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;

class UpdateAdminController extends AdminController
{
    #[OAT\Patch(path: '/admins/admins/{id}', tags: ['adminsAdmins'])]
    #[JsonRequestBody(UpdateAdminResponseData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateAdminRequestData $request)
    {

        Log::info('hello world');

        $user =
            User::query()
                ->firstWhere(
                    'id',
                    $request->id
                );

        if (isset($request->password)) {

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
