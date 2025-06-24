<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\GetExam\Request\GetExamRequestData;
use App\Data\Admin\Exam\GetExam\Response\GetExamResponseData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

class GetExamController extends Controller
{
    #[OAT\Get(path: '/admins/exams/{id}', tags: ['adminsExams'])]
    #[JsonRequestBody(GetExamRequestData::class)]
    #[SuccessItemResponse(GetExamResponseData::class)]
    public function __invoke(GetExamRequestData $request)
    {

        // $course_exams =
        //     Exam::query()
        //         ->where(
        //             'course_teacher_id',
        //             $request->id
        //         )
        //         ->get();

        // return $course_exams;

    }
}
