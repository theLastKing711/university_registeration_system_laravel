<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\GetExamsSchedule\Request\GetExamsScheduleRequestData;
use App\Data\Admin\Exam\GetExamsSchedule\Response\GetExamsScheduleResponseData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Support\Carbon;
use OpenApi\Attributes as OAT;
use Spatie\LaravelPdf\Facades\Pdf;

class GetExamsScheduleController extends Controller
{
    #[OAT\Get(path: '/admins/exams', tags: ['adminsExams'])]
    #[QueryParameter('department_id', ' integer')]
    #[QueryParameter('academic_year_semester', ' integer')]
    #[SuccessListResponse(GetExamsScheduleResponseData::class)]
    public function __invoke(GetExamsScheduleRequestData $request)
    {

        $unique_exam_times =
           Exam::query()
               ->select('from', 'to')
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
               ->get()
               ->unique('from', 'to');

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
                ->get()
                ->groupBy(['date', 'from', 'to']);

        $exam_schedule_table = [];

        $exam_schedule_table_index = 0;

        foreach ($grouped_exams as $date => $date_values) {

            $exam_schedule_table[$exam_schedule_table_index]['id'] =
                $exam_schedule_table_index + 1;
            $exam_schedule_table[$exam_schedule_table_index]['date'] =
                 $date;
            $exam_schedule_table[$exam_schedule_table_index]['day'] =
             Carbon::parse($date)->day;

            foreach ($unique_exam_times as $time_slot_key => $time_slot_value) {
                $exam_schedule_table[$exam_schedule_table_index]['exams'][] =
                isset($date_values[$time_slot_value->from])
                ?
                    $date_values[$time_slot_value->from][$time_slot_value->to]
                    :
                    [];
            }

            $exam_schedule_table_index++;

        }

        // Pdf::view(
        //     'pdf.exams-schedule',
        //     [
        //         'table_headers' => $table_headers,
        //         'table_data' => $exam_schedule_table,
        //     ]
        // )
        //     ->save(storage_path().'/invoice.pdf');

        return
            Pdf::view(
                'pdf.exams-schedule',
                [
                    'table_headers' => $table_headers,
                    'table_data' => $exam_schedule_table,
                ]
            )
                ->name('exam Schedule '.Carbon::now()->format('Y-m-d H:i:s').'.pdf')
                ->download('exams_test.pdf');
    }
}
