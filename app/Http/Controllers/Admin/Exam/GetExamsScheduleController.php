<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\GetExamsSchedule\Request\GetExamsScheduleRequestData;
use App\Data\Admin\Exam\GetExamsSchedule\Response\GetExamsScheduleResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Support\Carbon;
use OpenApi\Attributes as OAT;

class GetExamsScheduleController extends Controller
{
    #[OAT\Get(path: '/admins/exams', tags: ['adminsExams'])]
    #[SuccessListResponse(GetExamsScheduleResponseData::class)]
    public function __invoke(GetExamsScheduleRequestData $request)
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

        return GetExamsScheduleResponseData::collect(

        );
    }
}
