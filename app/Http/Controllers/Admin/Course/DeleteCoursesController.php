<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\DeleteCoursesRequestData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\ListQueryParameter;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use OpenApi\Attributes as OAT;

class DeleteCoursesController extends Controller
{
    #[OAT\Delete(path: '/admins/courses', tags: ['adminsCourses'])]
    #[ListQueryParameter]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteCoursesRequestData $request)
    {
        Course::query()
            ->whereIn(
                'id',
                $request
                    ->ids
            )
            ->delete();
    }
}
