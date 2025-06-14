<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\AssignMarkToStudentRequestData;
use App\Data\Admin\Student\ExamStudentItemData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class AssignMarkToStudentController extends Controller
{
    #[OAT\Post(path: '/admins/students/assignMarkToStudent', tags: ['adminsStudents'])]
    #[JsonRequestBody(AssignMarkToStudentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(AssignMarkToStudentRequestData $request)
    {

        $exam =
            Exam::query()
                ->firstWhere(
                    'id',
                    $request->exam_id
                );

        $exam_attach_data =
            $request->exam_students->mapWithKeys(function (ExamStudentItemData $student, &$exam_attach_data) {

                return [$student->student_id => ['mark' => $student->mark]];

            })
                ->all();

        $exam
            ->students()
            ->attach($exam_attach_data);

    }
}
