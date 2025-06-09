<?php

namespace App\Http\Controllers\Student\Course;

use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Data\Student\Course\RegisterCoursesRequestData as CourseRegisterCoursesRequestData;
use App\Http\Controllers\Controller;
use App\Models\Prerequisite;
use App\Models\StudentCourseRegisteration;
use App\Models\User;
use Log;
use OpenApi\Attributes as OAT;

class RegisterCoursesController extends Controller
{
    #[OAT\Post(path: '/students/courses', tags: ['studentsCourses'])]
    #[JsonRequestBody(CourseRegisterCoursesRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CourseRegisterCoursesRequestData $request)
    {

        $student =
            User::query()
                ->firstWhere(
                    'id',
                    operator: 1
                );

        $unique_courses_prerequisites_ids =
            Prerequisite::query()
                ->whereIn(
                    'course_id',
                    $request->course_ids
                )
                ->pluck('prerequisite_id')
                ->unique()
                ->collect();

        Log::info($unique_courses_prerequisites_ids);

        $student_passed_courses_for_prerequisites = StudentCourseRegisteration::query()
            ->with([
                'course.course',
                'student',
            ])
            ->where('final_mark', '>=', 60)
            ->whereHas('course.course', fn ($query) => $query->whereIn('id', $unique_courses_prerequisites_ids)
            )
            ->where('student_id', $student->id)
            ->get()
            // ->unique('course.course.id')
            ->pluck('course.course.id')
            ->unique();

        Log::info($student_passed_courses_for_prerequisites);

        return $unique_courses_prerequisites_ids->diff($student_passed_courses_for_prerequisites);

        $student
            ->courses()
            ->attach(
                $request->course_ids,
            );

    }
}
