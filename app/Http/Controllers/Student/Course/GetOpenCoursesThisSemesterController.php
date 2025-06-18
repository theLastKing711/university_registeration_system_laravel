<?php

namespace App\Http\Controllers\Student\Course;

use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\Course\GetOpenCoursesThisSemester\Response\GetOpenCoursesThisSemesterResponseData;
use App\Data\Student\Course\QueryParameters\GetOpenCoursesThisSemesterQueryParameterData;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentRegisterationPeriod;
use App\Models\OpenCourseRegisteration;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetOpenCoursesThisSemesterController extends Controller
{
    #[OAT\Get(path: '/students/courses', tags: ['studentsCourses'])]
    #[QueryParameter('year', 'integer')]
    #[QueryParameter('semester', 'integer')]
    #[SuccessListResponse(GetOpenCoursesThisSemesterResponseData::class)]
    public function __invoke(GetOpenCoursesThisSemesterQueryParameterData $queryParameterData)
    {

        /** @var User $logged_user */
        $logged_user =
            User::query()
                ->with('department')
                ->firstWhere(
                    'id',
                    1
                    // operator: Auth::User()->id
                );

        $departments =
            Department::query()
                ->where(
                    'id',
                    $logged_user->id
                )
                ->orWhere(
                    'id',
                    null
                );

        $logged_user_department =
                $logged_user
                    ->department;

        /** @var DepartmentRegisterationPeriod $department_latest_open_registeration */
        $department_latest_open_registeration = DepartmentRegisterationPeriod::query()
            ->where(
                'is_open_for_students',
                true,
            )
            ->where(
                'department_id',
                $logged_user->department_id
            )
            ->orderBy('year', 'desc')
            ->orderBy('semester', 'desc')
            ->first();

        return DB::table('courses')
            ->leftJoin('departments', 'courses.department_id', 'departments.id')
            ->join('open_course_registerations', 'open_course_registerations.course_id', 'courses.id')
            ->where('open_course_registerations.year', $department_latest_open_registeration->year)
            ->where('open_course_registerations.semester', $department_latest_open_registeration->semester)
            ->whereNested(function ($query) use ($logged_user_department) {
                $query
                    ->where('departments.id', $logged_user_department->id)
                    ->orWhere('courses.department_id', null);

            })
            ->select('open_course_registerations.*', 'courses.*')
            ->paginate(perPage: 10);

        // return
        //     OpenCourseRegisteration::query()
        //         ->with('course')
        //         ->where(
        //             'year',
        //             $logged_user_department->course_registeration_year
        //         )
        //         ->where(
        //             'semester',
        //             $logged_user_department->course_registeration_semester
        //         )
        //         ->whereRelation(
        //             'course.department',
        //             'id',
        //             $logged_user_department->id
        //         )
        //         ->orWhereRelation(
        //             'course',
        //             'department_id',
        //             null
        //         )
        //         ->cursorPaginate(10);

        // $logged_user_department =
        //     Department::query()
        //         ->firstWhere(
        //             'id',
        //             $logged_user_department_id
        //         )
        //         ->with(
        //             relations: [
        //                 'courses' => [
        //                     'openCourseRegisterations' => fn ($query) => $query
        //                         ->where('year', 'departments.course_registeration_year')
        //                         ->where(
        //                             'semester',
        //                             'departments.course_registeration_semester'
        //                         ),
        //                 ],
        //             ]
        //         )
        //         ->get();

        // return $logged_user_department;

        // $logged_user_open_courses =
        //     $logged_user
        //         ->courses
    }
}
