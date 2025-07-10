<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemester\Request\GetStudentRegisteredOpenCoursesThisSemesterRequestData;
use App\Data\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemester\Response\GetStudentRegisteredOpenCoursesThisSemesterResponsePaginationResultData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetStudentRegisteredOpenCoursesThisSemesterController extends Controller
{
    #[OAT\Get(path: '/students/course-registerations/registered-courses/this-semester', tags: ['studentsOpenCourseRegisterations'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetStudentRegisteredOpenCoursesThisSemesterResponsePaginationResultData::class)]
    public function __invoke(GetStudentRegisteredOpenCoursesThisSemesterRequestData $request)
    {

        $logged_user =
            User::query()
                ->with(
                    [
                        'department' => [
                            'openRegisterations',
                        ],
                    ]
                )
                ->firstWhere(
                    'id',
                    operator: Auth::User()->id
                );

        $current_year_semester =
                $logged_user
                    ->department
                    ->openRegisterations
                    ->firstWhere(
                        'is_open_for_students',
                        true
                    );

        $student_registered_courses =
            $logged_user
                ->load([
                    'courses' => fn ($query) => $query
                        ->with('course')
                        ->where(
                            'academic_year_semester_id',
                            $current_year_semester->id
                        ),
                ])
                ->courses
                ->paginate(1);

        return
            GetStudentRegisteredOpenCoursesThisSemesterRequestData::collect(
                $student_registered_courses
            );

        // return
        //     StudentCourseRegisteration::query()
        //         ->withWhereHas('course', function ($query) {
        //             $query
        //                 ->where(
        //                     'year',
        //                     2014
        //                     // $current_year_semester->year
        //                 )
        //                 ->where(
        //                     'semester',
        //                     1
        //                     // $current_year_semester->semester
        //                 );
        //         })
        //         ->paginate(1);

    }
}
