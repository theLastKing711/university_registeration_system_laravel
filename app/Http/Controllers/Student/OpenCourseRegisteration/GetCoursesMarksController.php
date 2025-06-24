<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Request\GetCoursesMarksRequestData;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Response\GetCoursesMarksResponseData;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Response\GetCoursesMarksResponsePaginationResultData;
use App\Http\Controllers\Controller;
use App\Models\StudentCourseRegisteration;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetCoursesMarksController extends Controller
{
    #[OAT\Get(path: '/students/course-registerations/registered-courses/marks', tags: ['studentMarks'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetCoursesMarksResponsePaginationResultData::class)]
    public function __invoke(GetCoursesMarksRequestData $request)
    {
        $logged_user_id
            = Auth::User()->id;

        $student_marks =
            StudentCourseRegisteration::query()
                ->with(
                    [
                        'course' => [
                            'course',
                        ],
                    ]
                )
                ->where(
                    'student_id',
                    $logged_user_id
                )
                ->paginate($request->perPage);

        return GetCoursesMarksResponseData::collect($student_marks);
    }
}
