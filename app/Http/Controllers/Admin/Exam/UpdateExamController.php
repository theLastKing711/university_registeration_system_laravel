<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\UpdateExam\Request\UpdateExamRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Exam\Abstract\ExamController;
use App\Models\CourseTeacher;
use App\Models\Exam;
use DB;
use OpenApi\Attributes as OAT;

class UpdateExamController extends ExamController
{
    #[OAT\Patch(path: '/admins/exams/{id}', tags: ['adminsExams'])]
    #[JsonRequestBody(UpdateExamRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateExamRequestData $request)
    {

        DB::transaction(function () use ($request) {

            $course_teacher =
            CourseTeacher::query()
                ->firstWhere(
                    [
                        'course_id' => $request->course_id,
                        'teacher_id' => $request->teacher_id,
                    ]
                );

            $exam =
                  Exam::query()
                      ->firstWhere(
                          'id',
                          $request->id
                      );

            $exam
                ->update(
                    [
                        'classroom_id' => $request->classroom_id,
                        'course_teacher_id' => $course_teacher->id,
                        'from' => $request->from,
                        'date' => $request->date,
                        'to' => $request->to,
                        'is_main_exam' => $request->is_main_exam,
                        'max_mark' => $request->max_mark,
                    ]
                );

            $exam
                ->examStudents()
                ->delete();

            $exam_students_data =
               $request
                   ->exam_students
                   ->map(fn ($item) => [
                       'student_id' => $item->student_id,
                       'mark' => $item->mark,
                   ]
                   )
                   ->all();

            $exam
                ->examStudents()
                ->createMany(
                    $exam_students_data
                );

        });

    }
}
