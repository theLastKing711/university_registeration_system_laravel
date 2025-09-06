<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Data\Student\OpenCourseRegisteration\RegisterInOpenCourse\Request\RegisterInOpenCourseRequestData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class RegisterInOpenCourseController extends Controller
{
    #[OAT\Post(path: '/students/opencourseregisterations/{id}', tags: ['studentsOpenCourseRegisterations'])]
    #[JsonRequestBody(RegisterInOpenCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(RegisterInOpenCourseRequestData $request)
    {

        $logged_student =
            User::query()
                ->firstWhere(
                    'id',
                    operator: Auth::User()->id
                );

        $logged_student
            ->courses()
            ->attach([
                $request
                    ->id,
            ]);

    }
}
