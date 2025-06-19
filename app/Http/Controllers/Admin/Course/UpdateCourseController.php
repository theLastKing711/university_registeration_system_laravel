<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\UpdateCourse\Request\Admin\Course\UpdateCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/courses/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/adminsUpdateCoursePathParameterData',
            ),
        ],
    ),
]
class UpdateCourseController extends Controller
{
    #[OAT\Patch(path: '/admins/courses/{id}', tags: ['adminsCourses'])]
    #[JsonRequestBody(UpdateCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateCourseRequestData $request, Course $course)
    {

        Course::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->update(
                $request->all()
            );

    }
}
