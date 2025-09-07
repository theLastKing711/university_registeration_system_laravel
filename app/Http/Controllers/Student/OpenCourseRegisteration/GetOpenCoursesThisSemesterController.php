<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetOpenCoursesThisSemester\Request\GetOpenCoursesThisSemesterRequestData;
use App\Data\Student\OpenCourseRegisteration\GetOpenCoursesThisSemester\Response\GetOpenCoursesThisSemesterResponseData;
use App\Enum\Currency;
use App\Http\Controllers\Controller;
use App\Models\DepartmentRegisterationPeriod;
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
            ->join(
                'academic_year_semesters',
                'academic_year_semesters.id',
                'open_course_registerations.academic_year_semester_id'
            )
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
                'open_course_registerations.id',
                'academic_year_semesters.year',
                'academic_year_semesters.semester',
            )
            ->addSelect(
                FacadesDB::raw("open_course_registerations.price_in_usd * {$syp_usd_exchange_rate} as price"),
            )
            ->addSelect(column: [
                'is_student_registered_in_open_coruse' => function ($query) use ($logged_user) {
                    $query
                        ->select(
                            DB::raw(
                                "EXISTS(SELECT 1 FROM student_course_registerations WHERE student_course_registerations.course_id=open_course_registerations.id && student_id = {$logged_user->id})"
                            ),
                        );
                },
            ])
            ->paginate(perPage: 10);

    }
}
