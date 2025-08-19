<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetCoursesList\Request\GetCoursesListRequestData;
use App\Data\Admin\Course\GetCoursesList\Response\GetCoursesListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use OpenApi\Attributes as OAT;

class GetCoursesListController extends Controller
{
    #[OAT\Get(path: '/admins/courses/list', tags: ['adminsCourses'])]
    #[SuccessListResponse(GetCoursesListResponseData::class)]
    public function __invoke(GetCoursesListRequestData $request)
    {
        return GetCoursesListResponseData::collect(
            Course::query()
                ->select([
                    'id',
                    'name',
                ])
                ->when(
                    $request->department_id,
                    fn ($query) => $query
                        ->where(
                            'department_Id',
                            $request->department_id
                        )
                        ->orWhere(
                            'department_id',
                            null
                        )
                )
                ->get()
        );
    }
}
