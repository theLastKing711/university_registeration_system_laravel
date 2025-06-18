<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\CreateCourse\Request\CreateCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;

class CreateCourseController extends Controller
{
    #[OAT\Post(path: '/admins/courses', tags: ['adminsCourses'])]
    #[JsonRequestBody(CreateCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateCourseRequestData $request)
    {

        Log::info(json_encode($request->prerequisites_ids));

        $course = new Course;

        $course->name = $request->name;
        $course->code = $request->code;
        $course->is_active = $request->is_active;
        $course->credits = $request->credits;
        $course->department_id = $request->department_id;

        DB::transaction(function () use ($course, $request) {

            /** @var Course $created_course */
            $created_course = Course::create(attributes: $course->toArray());

            $created_course
                ->coursesPrerequisites()
                ->attach(
                    $request->prerequisites_ids
                );

        });

    }
}
