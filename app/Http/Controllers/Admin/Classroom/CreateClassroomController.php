<?php

namespace App\Http\Controllers\Admin\Classroom;

use App\Data\Admin\Classroom\CreateClassroom\Request\CreateClassroomRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use OpenApi\Attributes as OAT;

class CreateClassroomController extends Controller
{
    #[OAT\Post(path: '/admins/classrooms', tags: ['adminsClassrooms'])]
    #[JsonRequestBody(CreateClassroomRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateClassroomRequestData $request)
    {

        Classroom::query()
            ->create([
                'name' => $request->name,
            ]);

    }
}
