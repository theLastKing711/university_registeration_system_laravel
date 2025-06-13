<?php

namespace App\Http\Controllers\Admin\Course;

use App\Data\Admin\Course\OpenForRegisterationRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\DepartmentRegisterationPeriod;
use App\Models\OpenCourseRegisteration;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class OpenForRegisterationController extends Controller
{
    #[OAT\Post(path: '/admins/courses/openForRegisteration', tags: ['adminsCourses'])]
    #[JsonRequestBody(OpenForRegisterationRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(OpenForRegisterationRequestData $request)
    {

        // $logged_user =
        //     Auth::User();

        $courses_department =
            Department::query()
                ->firstWhere(
                    'id',
                    $request->department_id
                );

        /** @var DepartmentRegisterationPeriod $latestTimeDepartentOpenRegisteration */
        $latestTimeDepartentOpenRegisteration =
            DepartmentRegisterationPeriod::query()
                ->where('department_id', $courses_department->id)
                ->orderBy('year', 'desc')
                ->orderBy('semester', 'desc')
                ->first();

        Course::query()
            ->whereIn(
                'id',
                $request->courses_ids
            )
            ->get()
            ->each(function (Course $course) use ($latestTimeDepartentOpenRegisteration) {

                $open_course_registeration = new OpenCourseRegisteration;

                $open_course_registeration->year =
                    $latestTimeDepartentOpenRegisteration->year;

                $open_course_registeration->semester =
                     $latestTimeDepartentOpenRegisteration->semester;

                // $open_course_registeration->year =
                //     $courses_department->course_registeration_year;

                // $open_course_registeration->semester =
                //     $courses_department->course_registeration_semester;

                $course
                    ->openCourseRegisterations()
                    ->save(model: $open_course_registeration);

            });

    }
}
