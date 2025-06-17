<?php

namespace App\Http\Controllers\Student\Course;

use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\Course\GetCoursesMarks\Request\GetCoursesMarksRequestQueryParameterData;
use App\Data\Student\Course\GetCoursesMarks\Respone\GetCoursesMarksResponseData;
use App\Http\Controllers\Controller;
use App\Models\StudentCourseRegisteration;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetCoursesMarksController extends Controller
{
    #[OAT\Get(path: '/students/courses/marks', tags: ['studentsCourses'])]
    #[QueryParameter('year')]
    #[QueryParameter('semester')]
    #[SuccessListResponse(GetCoursesMarksResponseData::class)]
    public function __invoke(GetCoursesMarksRequestQueryParameterData $request)
    {

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
