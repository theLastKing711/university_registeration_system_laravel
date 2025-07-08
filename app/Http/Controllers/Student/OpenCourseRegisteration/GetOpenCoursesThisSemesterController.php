<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetOpenCoursesThisSemester\Response\GetOpenCoursesThisSemesterResponseData;
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
    #[OAT\Get(path: '/students/open-course-registerations', tags: ['studentsOpenCourseRegisterations'])]
    #[SuccessListResponse(GetOpenCoursesThisSemesterResponseData::class)]
    public function __invoke()
    {

        $logged_user =
            User::query()
                ->with('department')
                ->firstWhere(
                    'id',
                    Auth::User()->id
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
            ->orderBy('academic_year_semester_id', 'desc')
            ->first();

        return DB::table('courses')
            ->leftJoin('departments', 'courses.department_id', 'departments.id')
            ->join('open_course_registerations', 'open_course_registerations.course_id', 'courses.id')
            ->where('open_course_registerations.academic_year_semester_id', $department_latest_open_registeration->academic_year_semester_id)
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
