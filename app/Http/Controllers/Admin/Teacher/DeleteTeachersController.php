<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\DeleteTeacher\Request\DeleteTeachersRequestData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\ListQueryParameter;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class DeleteTeachersController extends Controller
{
    #[OAT\Delete(path: '/admins/teachers/{id}', tags: ['adminsTeachers'])]
    #[ListQueryParameter]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteTeachersRequestData $request)
    {
        Teacher::query()
            ->whereIn(
                'id',
                $request
                    ->ids
            )
            ->delete();
    }
}
