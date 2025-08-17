<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\GetTeachersList\Response\GetTeachersListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class GetTeachersListController extends Controller
{
    #[OAT\Get(path: '/admins/teachers/list', tags: ['adminsTeachers'])]
    #[SuccessListResponse(GetTeachersListResponseData::class)]
    public function __invoke()
    {
        return
            GetTeachersListResponseData::collect(
                Teacher::query()
                    ->select([
                        'id',
                        'name',
                    ])
                    ->get()
            );

    }
}
