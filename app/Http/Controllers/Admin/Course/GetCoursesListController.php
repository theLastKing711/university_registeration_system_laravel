<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetCoursesList\Request\GetCoursesListRequestData;
use App\Data\Admin\Course\GetCoursesList\Response\GetCoursesListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class GetCoursesListController extends Controller
{
    #[OAT\Get(path: '/admins/courses/list', tags: ['adminsCourses'])]
    #[SuccessListResponse(GetCoursesListResponseData::class)]
    public function __invoke(GetCoursesListRequestData $request)
    {

        return GetCoursesListResponseData::collect(
            OpenCourseRegisteration::query()
                ->select([
                    'id',
                    'course_id',
                ])
                ->with(
                    'course:id,name'
                )
                ->when(
                    $request->academic_year_semester_id,
                    fn ($query) => $query
                        ->where(
                            'academic_year_semester_id',
                            $request->academic_year_semester_id
                        )
                )
                ->when(
                    $request->department_id,
                    fn ($query) => $query
                        ->whereRelation(
                            'course',
                            'department_id',
                            $request->department_id
                        )
                        ->orWhereRelation(
                            'course',
                            'department_id',
                            null
                        )
                )
                ->get()
        );
    }
}
