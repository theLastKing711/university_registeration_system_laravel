<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\GetCourseTeacherLectures\Request\GetCourseTeacherLecturesRequestData;
use App\Data\Admin\CourseTeacher\GetCourseTeacherLectures\Response\GetCourseTeacherLecturesResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Admin\CourseTeacher\Abstract\CourseTeacherLecturesController;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class GetCourseTeacherLecturesController extends CourseTeacherLecturesController
{
    #[OAT\Get(path: '/admins/course-teachers/{id}/lectures', tags: ['adminsCourseTeachers'])]
    #[SuccessListResponse(GetCourseTeacherLecturesResponseData::class)]
    public function __invoke(GetCourseTeacherLecturesRequestData $request)
    {
        return
            GetCourseTeacherLecturesResponseData::collect(
                CourseTeacher::query()
                    ->with('lectures')
                    ->firstWhere(
                        'id',
                        $request->id
                    )
                    ->lectures
            );
    }
}
