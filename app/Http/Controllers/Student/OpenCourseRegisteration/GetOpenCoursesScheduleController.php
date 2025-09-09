<?php

namespace App\Http\Controllers\Student\OpenCourseRegisteration;

use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Data\Student\OpenCourseRegisteration\GetCoursesScheduleThisSemester\Response\GetCoursesScheduleThisSemesterResponseData;
use App\Http\Controllers\Controller;
use App\Models\ClassroomCourseTeacher;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;
use Spatie\LaravelPdf\Facades\Pdf;

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
                ->orderBy('from')
                ->get()
                ->groupBy([
                    'from',
                    'to',
                    'day',
                ]);

        $student_courses_schedule_header =
            [
                'السبت',
                'الأحد',
                'الاثنين',
                'الثلاثاء',
                'الأربعاء',
                'الخميس',
                'الجمعة',
            ];

        $student_courses_schedule_array =
                [];

        // $row_index = 0;

        foreach ($student_course_schedule as $from => $to_data) {

            foreach ($to_data as $to => $classroom_course_data) {

                foreach ($student_courses_schedule_header as $day_index => $day) {

                    if (
                        isset(
                            $student_course_schedule[$from][$to][$day_index]
                        )
                    ) {
                        $student_courses_schedule_array["{$from}-{$to}"][$day_index] =
                            $student_course_schedule[$from][$to][$day_index]
                                ->pluck(
                                    'courseTeacher.course.course.name'
                                );

                    } else {
                        $student_courses_schedule_array["{$from}-{$to}"][$day_index] =
                            [];
                    }
                }

                // $row_index++;

            }

        }

        return
            Pdf::view(
                'pdf.student.courses-schedule',
                [
                    'table_headers' => ['', ...$student_courses_schedule_header],
                    'table_data' => $student_courses_schedule_array,
                ]
            )
                ->name('courses schedule'.Carbon::now()->format('Y-m-d H:i:s').'.pdf')
                ->download('courses schedule.pdf');

    }
}
