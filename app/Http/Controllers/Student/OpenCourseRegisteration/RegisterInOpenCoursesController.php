<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Data\Student\OpenCourseRegisteration\RegisterCourses\Request\RegisterInOpenCoursesRequestData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class RegisterInOpenCoursesController extends Controller
{
    #[OAT\Post(path: '/students/open-course-registerations', tags: ['studentsOpenCourseRegisterations'])]
    #[JsonRequestBody(RegisterInOpenCoursesRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(RegisterInOpenCoursesRequestData $request)
    {

        $student =
            User::query()
                ->firstWhere(
                    'id',
                    operator: Auth::User()->id
                );

        $student
            ->courses()
            ->attach(
                $request->open_courses_ids,
            );

    }
}
