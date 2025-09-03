<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Data\Admin\Exam\GetExams\Request\GetExamsRequestData;
use App\Data\Admin\Exam\GetExams\Response\GetExamsResponseData;
use App\Data\Admin\Exam\GetExams\Response\GetExamsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use OpenApi\Attributes as OAT;

class GetExamsController extends Controller
{
    #[OAT\Get(path: '/admins/exams', tags: ['adminsExams'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetExamsResponsePaginationResultData::class)]
    public function __invoke(GetExamsRequestData $request)
    {

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
                ->paginate($request->perPage)
        );
    }
}
