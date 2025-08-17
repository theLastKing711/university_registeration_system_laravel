<?php

namespace App\Http\Controllers\Admin\Classroom;

use App\Data\Admin\Classroom\GetClassroom\Request\GetClassroomRequestData;
use App\Data\Admin\Classroom\GetClassroom\Response\GetClassroomResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use OpenApi\Attributes as OAT;

class GetClassroomController extends Controller
{
    #[OAT\Get(path: '/admins/classrooms/{id}', tags: ['adminsClassrooms'])]
    #[SuccessItemResponse(GetClassroomResponseData::class)]
    public function __invoke(GetClassroomRequestData $request)
    {
        return GetClassroomResponseData::from(
            Classroom::query()
                ->firstWhere(
                    'id',
                    $request->id
                )
        );
    }
}
