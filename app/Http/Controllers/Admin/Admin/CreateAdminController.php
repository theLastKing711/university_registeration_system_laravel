<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\CreateAdminRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class CreateAdminController extends Controller
{
    #[OAT\Post(path: '/admins/admins', tags: ['adminsAdmins'])]
    #[JsonRequestBody(CreateAdminRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateAdminRequestData $request)
    {
        User::query()
            ->create([
                'name' => $request->name,
                'password' => $request->password,
            ]);

    }
}
