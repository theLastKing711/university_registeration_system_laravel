<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\GetTeachers\Response\GetTeachersResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class GetTeachersController extends Controller
{
    #[OAT\Get(path: '/admins/teachers', tags: ['adminsTeachers'])]
    #[SuccessListResponse(GetTeachersResponseData::class)]
    public function __invoke()
    {
        GetTeachersResponseData::collect(
            Teacher::query()
                ->get()
        );

    }
}
