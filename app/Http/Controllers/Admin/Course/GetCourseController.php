<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\GetCourse\Response\GetCourseResponseData;
use App\Data\Admin\Course\GetCourseRequest\Request\GetCourseRequestData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Admin\Course\Abstract\CourseController;
use App\Models\Course;
use OpenApi\Attributes as OAT;

class GetCourseController extends CourseController
{
    #[OAT\Get(path: '/admins/courses/{id}', tags: ['adminsCourses'])]
    #[SuccessItemResponse(GetCourseResponseData::class)]
    public function __invoke(GetCourseRequestData $request)
    {

        $course =
            Course::query()
                ->with(
                    [
                        'department',
                        'coursesPrerequisites',
                        'firstCrossListed',
                        'secondCrossListed',
                    ]
                )
                ->firstWhere(
                    'id',
                    $request->id
                );

        return
            GetCourseResponseData::from(
                $course
            );
    }
}
