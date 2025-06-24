<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarksThisSemester\Request\GetCoursesMarksRequestThisSemesterRequestData;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarksThisSemester\Respone\GetCoursesMarksThisSemesterResponseData;
use App\Http\Controllers\Controller;
use App\Models\StudentCourseRegisteration;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetCoursesMarksThisSemesterController extends Controller
{
    #[OAT\Get(path: '/students/course-registerations/registered-courses/marks/this-semester', tags: ['studentMarks'])]
    #[QueryParameter('year')]
    #[QueryParameter('semester')]
    #[SuccessListResponse(GetCoursesMarksThisSemesterResponseData::class)]
    public function __invoke(GetCoursesMarksRequestThisSemesterRequestData $request)
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

        return GetCoursesMarksThisSemesterResponseData::collect($student_marks);

    }
}
