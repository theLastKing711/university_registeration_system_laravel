<?php

namespace App\Http\Controllers\Admin\Classroom;

use App\Data\Admin\Classroom\GetClassroomList\Request\GetClassroomListRequestData;
use App\Data\Admin\Classroom\GetClassroomList\Response\GetClassroomListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use OpenApi\Attributes as OAT;

class GetClassroomListController extends Controller
{
    #[OAT\Get(path: '/admins/classrooms/list', tags: ['adminsClassrooms'])]
    #[SuccessListResponse(GetClassroomListResponseData::class)]
    public function __invoke(GetClassroomListRequestData $request)
    {
        return GetClassroomListResponseData::collect(
            Classroom::query()
                ->get()
        );
    }
}
