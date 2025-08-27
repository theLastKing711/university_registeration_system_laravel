<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\GetExams\Request\GetExamsRequestData;
use App\Data\Admin\Exam\GetExams\Response\GetExamsResponseData;
use App\Data\Admin\Exam\GetExams\Response\GetExamsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use OpenApi\Attributes as OAT;

class GetExamsController extends Controller
{
    #[OAT\Get(path: '/admins/exams', tags: ['adminsExams'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetExamsResponsePaginationResultData::class)]
    public function __invoke(GetExamsRequestData $request)
    {

        $unique_exam_times =
            Exam::query()
                ->select('from', 'to')
                ->get()
                ->unique('from', 'to');

        // return $unique_exam_times;

        $time_slots_heades =
            $unique_exam_times
                ->map(
                    function ($time) {
                        $time_slot = Carbon::parse($time->from)->format('h:i:s A').' - '.Carbon::parse($time->to)->format('h:i:s A');

                        return $time_slot;
                    }
                );

        $table_headers =
            [
                '#',
                'التاريخ',
                'اليوم',
                ...$time_slots_heades,
            ];

        $grouped_exams =
            Exam::query()
                ->with('courseTeacher.course.course')
                ->orderBy('date')
                // ->limit(10)
                ->get()
                ->groupBy(['date', 'from', 'to']);

        $exam_schedule_table = [];

        $exam_schedule_table_index = 0;

        foreach ($grouped_exams as $date => $date_values) {

            $exam_schedule_table[$exam_schedule_table_index]['id'] = $exam_schedule_table_index + 1;
            $exam_schedule_table[$exam_schedule_table_index]['date'] = $date;
            $exam_schedule_table[$exam_schedule_table_index]['day'] = Carbon::parse($date)->day;

            foreach ($unique_exam_times as $time_slot_key => $time_slot_value) {
                $exam_schedule_table[$exam_schedule_table_index]['courses'] =
                isset($date_values[$time_slot_value->from])
                ?
                    $date_values[$time_slot_value->from][$time_slot_value->to]
                    :
                    null;
            }

            $exam_schedule_table_index++;

        }

        return $exam_schedule_table;

        return GetExamsResponseData::collect(
            Exam::query()
                ->with(
                    [
                        'classroom',
                        'courseTeacher' => [
                            'course' => [
                                'course:id,name',
                            ],
                            'teacher:id,name',
                        ],
                    ]
                )
                ->when(
                    $request->department_id,
                    fn ($query) => $query
                        ->whereRelation(
                            'courseTeacher.course.course',
                            'department_id',
                            $request->department_id
                        )
                )
                ->when(
                    $request->academic_year_semester_id,
                    fn ($query) => $query
                        ->whereRelation(
                            'courseTeacher.course',
                            'academic_year_semester_id',
                            $request->academic_year_semester_id
                        )
                )
                ->when(
                    $request->course_id,
                    fn ($query) => $query
                        ->whereRelation(
                            'courseTeacher.course',
                            'course_id',
                            $request->course_id
                        )
                )
                ->paginate()
        );
    }
}
