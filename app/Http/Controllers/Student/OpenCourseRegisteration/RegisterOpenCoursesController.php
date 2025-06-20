<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Data\Student\OpenCourseRegisteration\RegisterCourses\Request\RegisterOpenCoursesRequestData;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class RegisterOpenCoursesController extends Controller
{
    #[OAT\Post(path: '/students/course-registerations', tags: ['studentsCourses'])]
    #[JsonRequestBody(RegisterOpenCoursesRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(RegisterOpenCoursesRequestData $request)
    {

        $student =
            User::query()
                ->firstWhere(
                    'id',
                    operator: 1
                );

        $student
            ->courses()
            ->attach(
                $request->course_ids,
            );

    }
}
