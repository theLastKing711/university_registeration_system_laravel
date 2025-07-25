<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetCoursesScheduleThisSemester\Response\GetCoursesScheduleThisSemesterResponseData;
use App\Http\Controllers\Controller;
use App\Models\ClassroomCourseTeacher;
use DB;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetOpenCoursesScheduleController extends Controller
{
    #[OAT\Get(path: '/students/open-course-registerations/schedule', tags: ['studentsOpenCourseRegisterations'])]
    #[SuccessListResponse(GetCoursesScheduleThisSemesterResponseData::class)]
    public function __invoke()
    {

        $student_course_schedule =
            ClassroomCourseTeacher::query()
                ->with(
                    [
                        'classroom',
                        'courseTeacher:id,course_id,teacher_id' => [
                            'course:id,course_id' => [
                                'course:id,name',
                            ],
                            'teacher:id,name',
                        ],
                    ]
                )
                ->whereHas(
                    relation: 'courseTeacher',
                    callback: fn ($query) => $query
                        ->whereHas(
                            'course',
                            fn ($query) => $query
                                ->whereHas(
                                    'students',
                                    callback: fn ($query) => $query
                                        ->where(
                                            'users.id',
                                            Auth::User()->id
                                        )
                                )
                                ->whereHas(
                                    'course.department.openedAcademicyears',
                                    fn ($query) => $query
                                        ->where(
                                            'academic_year_semesters.id',
                                            DB::raw('open_course_registerations.academic_year_semester_id')
                                        )
                                        ->where(
                                            'is_open_for_students',
                                            true
                                        )
                                )
                        )
                )
                ->get();

        return GetCoursesScheduleThisSemesterResponseData::collect($student_course_schedule);

    }
}
