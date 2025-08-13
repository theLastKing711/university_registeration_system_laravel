<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\DeleteCourse\Request\DeleteCourseRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Course\Abstract\CourseController;
use App\Models\Course;
use OpenApi\Attributes as OAT;

class DeleteCourseController extends CourseController
{
    #[OAT\Delete(path: '/admins/courses/{id}', tags: ['adminsCourses'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteCourseRequestData $request)
    {

        Course::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->delete();

    }
}
