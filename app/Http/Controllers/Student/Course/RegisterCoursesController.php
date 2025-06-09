<?php

namespace App\Http\Controllers\Student\Course;

use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Data\Student\Course\RegisterCoursesRequestData as CourseRegisterCoursesRequestData;
use App\Http\Controllers\Controller;
use App\Models\User;
use OpenApi\Attributes as OAT;

class RegisterCoursesController extends Controller
{
    #[OAT\Post(path: '/students/courses', tags: ['studentsCourses'])]
    #[JsonRequestBody(CourseRegisterCoursesRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CourseRegisterCoursesRequestData $request)
    {

        $student =
            User::query()
                ->firstWhere(
                    'id',
                    4
                );

        $student
            ->courses()
            ->attach(
                $request->course_ids,
            );

    }
}
