<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetOpenCoursesThisSemester\Response\GetOpenCoursesThisSemesterResponseData;
use App\Enum\Currency;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentRegisterationPeriod;
use App\Models\OpenCourseRegisteration;
use App\Models\UsdCurrencyExchangeRate;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use OpenApi\Attributes as OAT;

class GetOpenCoursesThisSemesterController extends Controller
{
    #[OAT\Get(path: '/students/open-course-registerations', tags: ['studentsOpenCourseRegisterations'])]
    #[SuccessListResponse(GetOpenCoursesThisSemesterResponseData::class)]
    public function __invoke()
    {

        $syp_usd_exchange_rate =
            UsdCurrencyExchangeRate::query()
                ->firstWhere(
                    'currency',
                    Currency::SYP->value
                )
                ->rate;

        $logged_user =
            User::query()
                ->with('department')
                ->firstWhere(
                    'id',
                    Auth::User()->id
                );

        $logged_user_department =
                $logged_user
                    ->department;

        $department_active_year_semester_id =
            DepartmentRegisterationPeriod::GetDepartmentActiveAcademicYearSemesterByDepartmentId(
                $logged_user->department_id
            );

        return DB::table('courses')
            ->leftJoin('departments', 'courses.department_id', 'departments.id')
            ->join('open_course_registerations', 'open_course_registerations.course_id', 'courses.id')
            ->where(
                'open_course_registerations.academic_year_semester_id',
                $department_active_year_semester_id
            )
            ->whereNested(function ($query) use ($logged_user_department) {
                $query
                    ->where('departments.id', $logged_user_department->id)
                    ->orWhere('courses.department_id', null);

            })
            ->select(
                'courses.*',
                'open_course_registerations.id',
            )
            ->addSelect(
                FacadesDB::raw("open_course_registerations.price_in_usd * {$syp_usd_exchange_rate} as price"),
            )
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
