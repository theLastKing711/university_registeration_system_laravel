<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\GetTeacher\Request\GetTeacherRequestData;
use App\Data\Admin\Teacher\GetTeacher\Response\GetTeacherResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Admin\Teacher\Abstract\TeacherController;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class GetTeacherController extends TeacherController
{
    #[OAT\Get(path: '/admins/teachers/{id}', tags: ['adminsTeachers'])]
    #[SuccessItemResponse(GetTeacherResponseData::class)]
    public function __invoke(GetTeacherRequestData $request)
    {

        return
            GetTeacherResponseData::from(
                Teacher::query()
                    ->firstWhere(
                        'id',
                        $request->id
                    )
            );

    }
}
