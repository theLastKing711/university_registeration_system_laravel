<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\UpdateStudentExamMark\Request\ExamStudentItemData;
use App\Data\Admin\Exam\UpdateStudentExamMark\Request\UpdateStudentExamMarkRequestData;
use App\Data\Admin\Exam\UpdateStudentExamMark\Response\UpdateStudentExamMarkResponseData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Exam\Abstract\ExamStudentCotnroller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class UpdateStudentExamMarkController extends ExamStudentCotnroller
{
    #[OAT\Patch(path: '/admins/exams/{id}/students', tags: ['adminsExams'])]
    #[JsonRequestBody(UpdateStudentExamMarkResponseData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateStudentExamMarkRequestData $request)
    {

        $exam =
           Exam::query()
               ->firstWhere(
                   'id',
                   $request->id
               );

        $exam_attach_data =
            $request
                ->exam_students
                ->mapWithKeys(function (ExamStudentItemData $student) {

                    return [$student->student_id => ['mark' => $student->mark]];

                })
                ->all();

        $exam
            ->students()
            ->sync($exam_attach_data);

    }
}
