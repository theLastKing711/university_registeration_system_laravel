<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetCoursesMarksThisSemester\Respone\GetCoursesMarksThisSemesterResponseData;
use App\Http\Controllers\Controller;
use App\Models\DepartmentRegisterationPeriod;
use App\Models\StudentCourseRegisteration;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetCoursesMarksThisSemesterController extends Controller
{
    #[OAT\Get(path: '/students/open-course-registerations/marks/this-semester', tags: ['studentMarks'])]
    #[QueryParameter('year')]
    #[QueryParameter('semester')]
    #[SuccessListResponse(GetCoursesMarksThisSemesterResponseData::class)]
    public function __invoke()
    {

        $logged_user = Auth::User();

        $current_semester_year =
            DepartmentRegisterationPeriod::query()
                ->where(
                    [
                        'department_id' => $logged_user->department_id,
                        'is_open_for_students' => true,
                    ]
                )
                ->first();

        $student_marks =
            StudentCourseRegisteration::query()
                ->with(
                    [
                        'course' => [
                            'course',
                        ],
                    ]
                )
                ->whereHas(
                    'course',
                    fn ($query) => $query
                        ->where(
                            'academic_year_semester_id',
                            $current_semester_year
                        )
                )
                ->whereHas(
                    'student',
                    fn ($query) => $query
                        ->where(
                            'id',
                            $logged_user->id
                        )
                )
                ->get();

        return GetCoursesMarksThisSemesterResponseData::collect($student_marks);

    }
}
