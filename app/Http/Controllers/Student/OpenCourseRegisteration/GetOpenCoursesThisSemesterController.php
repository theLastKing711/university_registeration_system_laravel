<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetOpenCoursesThisSemester\Request\GetOpenCoursesThisSemesterRequestData;
use App\Data\Student\OpenCourseRegisteration\GetOpenCoursesThisSemester\Response\GetOpenCoursesThisSemesterResponseData;
use App\Enum\Currency;
use App\Http\Controllers\Controller;
use App\Models\DepartmentRegisterationPeriod;
use App\Models\OpenCourseRegisteration;
use App\Models\StudentCourseRegisteration;
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
    public function __invoke(GetOpenCoursesThisSemesterRequestData $request)
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

            ->leftJoin('departments', 'courses.department_id', operator: 'departments.id')
            ->join('open_course_registerations', 'open_course_registerations.course_id', 'courses.id')
            ->where(
                'open_course_registerations.academic_year_semester_id',
                $department_active_year_semester_id
            )
            ->when(
                $request->query,
                fn ($query) => $query
                    ->whereAny(
                        ['courses.name', 'courses.code'],
                        'LIKE',
                        "%$request->query%"
                    )
            )
            ->whereNested(function ($query) use ($logged_user_department) {
                $query
                    ->where('departments.id', $logged_user_department->id)
                    ->orWhere('courses.department_id', null);

            })
            ->select(
                'courses.*',
                'open_course_registerations.*',
            )
            ->addSelect(
                FacadesDB::raw("open_course_registerations.price_in_usd * {$syp_usd_exchange_rate} as price"),
            )
            ->addSelect([
                'is_student_registered_in_open_coruse' => function ($query) {
                    $query->select(DB::raw('EXISTS(SELECT 1 FROM student_course_registerations WHERE student_course_registerations.student_id=open_course_registerations.id)'));
                    // ->from('student_course_registerations') // Specify the table for the subquery
                    // ->whereColumn('student_course_registerations.course_id', 'open_course_registerations.id'); // Link the subquery to the main query
                },
            ])
            // ->addSelect(
            //     [
            //         'is_student_registered_in_course' => StudentCourseRegisteration::query()
            //             ->select('id')
            //             ->whereColumn('course_id', 'open_course_registerations.id')
            //             ->where('student_id', $logged_user->id)
            //             ->exists(),

            //     ]
            // )
            // ->addSelect(
            //     [
            //         'is_student_registered_in_course' => DB::raw(
            //             'SELECT EXISTS( SELECT 1 FROM student_course_registerations where course_id=open_course_registerations.id'
            //         ),
            //     ]
            // )
            ->paginate(perPage: 10);

        // return
        //     OpenCourseRegisteration::query()
        //         ->with('course')
        //         ->whereRelation(
        //             'course',
        //             'department_id',
        //             $logged_user_department->id
        //         )
        //         ->addSelect([
        //             'has_posts' => function ($query) {
        //                 $query->select(DB::raw('EXISTS(SELECT 1 FROM student_course_registerations WHERE student_course_registerations.student_id=open_course_registerations.id)'));
        //                 // ->from('student_course_registerations') // Specify the table for the subquery
        //                 // ->whereColumn('student_course_registerations.course_id', 'open_course_registerations.id'); // Link the subquery to the main query
        //             },
        //         ])
        // ->whereNested(function ($query) use ($logged_user_department) {
        //     $query
        //         ->whereRelation(
        //             'course.department',
        //             'id',
        //             $logged_user_department->id
        //         );
        //     // ->orWhereRelation(
        //     //     'course',
        //     //     'department_id',
        //     //     null
        //     // );
        // })
        // ->addSelect(
        //     [
        //         'is_student_registered_in_course' => DB::raw(
        //             'SELECT EXISTS( SELECT 1 FROM student_course_registerations where course_id=open_course_registerations.id'
        //         ),
        //     ]
        // )
        // ->selectRaw(
        //     'EXISTS( SELECT 1 FROM student_course_registerations where course_id=open_course_registerations.id ) AS TEST'
        // )
        // ->addSelect(
        // [
        //     'is_student_registered_in_course' => StudentCourseRegisteration::query()
        //         ->select(columns: DB::raw(1))
        //         ->whereColumn('course_id', '=', 'open_course_registerations.id')
        //         ->where('student_id', $logged_user->id)
        //         ->limit(1)
        //         ->exists(),
        //     // ->exists(),

        // ]
        // )
        // ->when(
        // $request->query,
        // fn ($query) => $query
        //     ->whereAny(
        //         ['courses.name', 'courses.code'],
        //         'LIKE',
        //         "%$request->query%"
        //     )
        // )
        // ->paginate(10);

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
