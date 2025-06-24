<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetCoursesScheduleThisSemester\Request\GetCoursesScheduleThisSemesterRequestData;
use App\Data\Student\OpenCourseRegisteration\GetCoursesScheduleThisSemester\Response\GetCoursesScheduleThisSemesterResponseData;
use App\Http\Controllers\Controller;
use App\Models\ClassroomCourseTeacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetOpenCoursesScheduleController extends Controller
{
    #[OAT\Get(path: '/students/course-registerations/offered-courses/schedule', tags: ['studentsCourses'])]
    #[QueryParameter('year')]
    #[QueryParameter('semester')]
    #[SuccessListResponse(GetCoursesScheduleThisSemesterResponseData::class)]
    public function __invoke(GetCoursesScheduleThisSemesterRequestData $request)
    {

        // return $logged_user =
        //     User::query()
        //         ->where(
        //             'id',
        //             2
        //         )
        //         ->with([
        //             'courses' => fn ($query) => $query
        //                 ->where(
        //                     'year',
        //                     $request->year
        //                 )
        //                 ->where(
        //                     'semester',
        //                     $request->semester
        //                 )
        //                 ->with([
        //                     'courseTeachers' => [
        //                         'teacher',
        //                         'classroomCourseTeachers' => [
        //                             'classroom',
        //                         ],
        //                     ],
        //                 ]),
        //         ])
        //         ->get();

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
                    'courseTeacher',
                    fn ($query) => $query
                        ->whereHas(
                            'course',
                            fn ($query) => $query
                                ->where(
                                    'year',
                                    $request->year
                                )
                                ->where(
                                    'semester',
                                    $request->semester
                                )
                                ->whereHas(
                                    'students',
                                    callback: fn ($query) => $query
                                        ->where(
                                            'users.id',
                                            Auth::User()->id
                                        )
                                )
                        )
                )
                ->get();

        return GetCoursesScheduleThisSemesterResponseData::collect($student_course_schedule);

    }
}
