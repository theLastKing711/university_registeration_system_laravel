<?php

namespace App\Http\Controllers\Admin\OpenCourseRegisteration;

use App\Data\Admin\OpenCourseRegisteration\OpenCourseForRegisteration\Request\OpenCourseForRegisterationRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CrossListedCourses;
use App\Models\DepartmentRegisterationPeriod;
use App\Models\OpenCourseRegisteration;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class OpenCourseForRegisterationController extends Controller
{
    #[OAT\Post(path: '/admins/open-course-registerations', tags: ['adminsOpenCourseRegisterations'])]
    #[JsonRequestBody(OpenCourseForRegisterationRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(OpenCourseForRegisterationRequestData $request)
    {

        $department_active_year_semester_id =
            DepartmentRegisterationPeriod::GetDepartmentActiveAcademicYearSemesterByDepartmentId(
                $request->department_id
            );

        DB::transaction(function () use ($department_active_year_semester_id, $request) {

            Course::query()
                ->with(relations: [
                    'firstCrossListedCourses',
                    'secondCrossListedCourses',
                ])
                ->whereIn(
                    'id',
                    $request->courses_ids
                )
                ->get()
                ->each(function (Course $course) use ($department_active_year_semester_id) {

                    $open_course_registeration = new OpenCourseRegisteration;

                    $open_course_registeration->academic_year_semester_id =
                        $department_active_year_semester_id;

                    $course
                        ->openCourseRegisterations()
                        ->save(model: $open_course_registeration);

                    $cross_listed_courses_ids =
                        $course
                            ->firstCrossListedCourses
                            ->merge($course->secondCrossListedCourses)
                            ->map(function (CrossListedCourses $crossListedCourses) use ($course) {

                                return
                                    $crossListedCourses->first_course_id
                                        ===
                                    $course->id
                                    ?
                                    $crossListedCourses->second_course_id
                                    :
                                    $crossListedCourses->first_course_id;
                            });

                    // $cross_listed_courses =
                    Course::query()
                        ->whereIn(
                            'id',
                            $cross_listed_courses_ids
                        )
                        ->get()
                        ->each(function (Course $cross_lised_course) use ($department_active_year_semester_id) {

                            $open_course_registeration = new OpenCourseRegisteration;

                            $open_course_registeration->academic_year_semester_id =
                                $department_active_year_semester_id;

                            $cross_lised_course
                                ->openCourseRegisterations()
                                ->save($open_course_registeration);

                        });
                });
        });

    }
}
