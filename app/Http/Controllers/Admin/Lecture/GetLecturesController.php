<?php

namespace App\Http\Controllers\Admin\Lecture;

use App\Data\Admin\Lecture\GetLectures\Request\GetLecturesRequestData;
use App\Data\Admin\Lecture\GetLectures\Response\GetLecturesResponseData;
use App\Data\Admin\Lecture\GetLectures\Response\GetLecturesResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Lecture;
use OpenApi\Attributes as OAT;

class GetLecturesController extends Controller
{
    #[OAT\Get(path: '/admins/lectures', tags: ['adminsLectures'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[QueryParameter('department_id', 'integer')]
    #[QueryParameter('academic_year_semester_id', 'integer')]
    #[QueryParameter('course_id', 'integer')]
    #[SuccessItemResponse(GetLecturesResponsePaginationResultData::class)]
    public function __invoke(GetLecturesRequestData $request)
    {

        return GetLecturesResponseData::collect(
            Lecture::query()
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
