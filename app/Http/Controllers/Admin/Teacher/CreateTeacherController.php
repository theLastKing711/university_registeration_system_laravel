<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Data\Admin\Teacher\CreateTeacher\Request\CreateTeacherRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use OpenApi\Attributes as OAT;

class CreateTeacherController extends Controller
{
    #[OAT\Post(path: '/admins/teachers', tags: ['adminsTeachers'])]
    #[JsonRequestBody(CreateTeacherRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateTeacherRequestData $request)
    {
        $teacher = new Teacher;

        $teacher->name = $request->name;
        $teacher->department_id = $request->department_id;

        $teacher->save();

    }
}
