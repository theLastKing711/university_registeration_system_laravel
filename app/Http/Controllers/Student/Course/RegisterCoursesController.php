<?php

namespace App\Http\Controllers\Student\Course;

use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Data\Student\Course\RegisterCourses\Request\RegisterCoursesRequestData;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class RegisterCoursesController extends Controller
{
    #[OAT\Post(path: '/students/courses', tags: ['studentsCourses'])]
    #[JsonRequestBody(RegisterCoursesRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(RegisterCoursesRequestData $request)
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
