<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\OpenForRegisterationRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;

class OpenForRegisterationController extends Controller
{
    #[OAT\Post(path: '/admins/courses/openForRegisteration', tags: ['adminsCourses'])]
    #[JsonRequestBody(OpenForRegisterationRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(OpenForRegisterationRequestData $request)
    {

        $courses_department = Department::query()
            ->firstWhere(
                'id',
                $request->department_id,
            );

        Course::query()
            ->whereIn(
                'id',
                $request->courses_ids
            )
            ->get()
            ->each(function (Course $course) use ($request) {

                $open_course_registeration = new OpenCourseRegisteration;

                $open_course_registeration->year =
                    $request->year;

                $open_course_registeration->semester =
                     $request->semester;

                // $open_course_registeration->year =
                //     $courses_department->course_registeration_year;

                // $open_course_registeration->semester =
                //     $courses_department->course_registeration_semester;

                $course
                    ->openCourseRegisterations()
                    ->save($open_course_registeration);

            });

    }
}
