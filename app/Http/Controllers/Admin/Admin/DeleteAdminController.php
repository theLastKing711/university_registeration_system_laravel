<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Data\Admin\Admin\DeleteAdmin\Request\DeleteAdminRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Student\Abstract\StudentController;
use App\Models\User;
use OpenApi\Attributes as OAT;

class DeleteAdminController extends StudentController
{
    #[OAT\Delete(path: '/admins/admins/{id}', tags: ['adminsAdmins'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteAdminRequestData $request)
    {

        User::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();

    }
}
