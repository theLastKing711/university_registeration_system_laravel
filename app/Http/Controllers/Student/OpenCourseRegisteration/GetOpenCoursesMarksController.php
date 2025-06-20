<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Request\GetCoursesMarksRequestQueryParameterData;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarks\Respone\GetCoursesMarksResponseData;
use App\Http\Controllers\Controller;
use App\Models\StudentCourseRegisteration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;

class GetOpenCoursesMarksController extends Controller
{
    #[OAT\Get(path: '/students/open-course-registerations/marks', tags: ['studentsCourses'])]
    #[QueryParameter('year')]
    #[QueryParameter('semester')]
    #[SuccessListResponse(GetCoursesMarksResponseData::class)]
    public function __invoke(GetCoursesMarksRequestQueryParameterData $request)
    {

        Log::info($request->all());

        $logged_user_id = Auth::User()->id;

        $student_marks =
            StudentCourseRegisteration::query()
                ->with(
                    [
                        'course' => [
                            'course',
                        ],
                        // 'student',
                    ]
                )
                ->whereHas(
                    'course',
                    fn ($query) => $query
                        ->where(
                            'year',
                            $request->year,
                        )->where(
                            'semester',
                            $request->semester,
                        )
                )
                ->whereHas(
                    'student',
                    fn ($query) => $query
                        ->where(
                            'id',
                            $logged_user_id
                        )
                )
                ->get();

        return GetCoursesMarksResponseData::collect($student_marks);

    }
}
