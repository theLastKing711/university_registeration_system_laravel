<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\CreateCourse\Request\CreateCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class CreateCourseController extends Controller
{
    #[OAT\Post(path: '/admins/courses', tags: ['adminsCourses'])]
    #[JsonRequestBody(CreateCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateCourseRequestData $request)
    {

        DB::transaction(function () use ($request) {
            $course = new Course;

            $course->department_id = $request->department_id;
            $course->name = $request->name;
            $course->code = $request->code;
            $course->is_active = $request->is_active;
            $course->credits = $request->credits;
            $course->open_for_students_in_year = $request->open_for_students_in_year;

            $course->save();

            $course
                ->coursesPrerequisites()
                ->sync(
                    $request
                        ->prerequisites
                        ->pluck('id')
                );

            $course
                ->firstCrossListed()
                ->sync(
                    $request
                        ->cross_listed_courses
                        ->pluck('id')
                );

        });

    }
}
