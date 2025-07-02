<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\UpdateCourse\Request\Admin\Course\UpdateCourseRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Course\Abstract\CourseController;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class UpdateCourseController extends CourseController
{
    #[OAT\Patch(path: '/admins/courses/{id}', tags: ['adminsCourses'])]
    #[JsonRequestBody(UpdateCourseRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateCourseRequestData $request, Course $course)
    {

        DB::transaction(function () use ($request) {

            $course = Course::query()
                ->firstWhere(
                    'id',
                    $request->id
                );

            $course->update(
                [
                    'department_id' => $request->department_id,
                    'name' => $request->name,
                    'code' => $request->code,
                    'is_active' => $request->is_active,
                    'open_for_students_in_year' => $request->open_for_students_in_year,
                    'credits' => $request->credits,
                ]
            );

            $course
                ->firstCrossListedCourses()
                ->delete();

            $course
                ->SecondCrossListedCourses()
                ->delete();

            $course
                ->firstCrossListed()
                ->sync(
                    $request
                        ->cross_listed_courses_ids
                );

            $course
                ->coursesPrerequisites()
                ->sync(
                    $request->prerequisites_ids
                );

        });

    }
}
