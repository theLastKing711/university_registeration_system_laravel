<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetCoursesList\Response\GetCoursesListResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use OpenApi\Attributes as OAT;

class GetCoursesListController extends Controller
{
    #[OAT\Get(path: '/admins/courses/list', tags: ['adminsCourses'])]
    #[SuccessListResponse(GetCoursesListResponseData::class)]
    public function __invoke()
    {
        return GetCoursesListResponseData::collect(
            Course::query()
                ->select([
                    'id',
                    'name',
                ])
                ->get()
        );
    }
}
