<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\UpdateCourseTeacherAttendace\Request\StudentAttendanceItemData;
use App\Data\Admin\CourseTeacher\UpdateCourseTeacherAttendace\Request\UpdateCourseTeacherRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\CourseTeacher\Abstract\CourseTeacherController;
use App\Models\CourseTeacher;
use OpenApi\Attributes as OAT;

class UpdateCourseTeacherAttendaceController extends CourseTeacherController
{
    #[OAT\Patch(path: '/admins/course-teachers/{id}/students', tags: ['adminsCourseTeachers'])]
    #[JsonRequestBody(UpdateCourseTeacherRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateCourseTeacherRequestData $request)
    {

        $student_attendace_attach_data =
            $request
                ->students_attendandces
                ->mapWithKeys(function (StudentAttendanceItemData $student) use ($request) {

                    return
                        [
                            $student->id => [
                                'is_student_present' => $student->is_student_present,
                                'date' => $request->date,
                            ],
                        ];

                })
                ->all();

        CourseTeacher::query()
            ->firstWhere(
                'id',
                $request->id
            )
            ->studenAttendances()
            ->sync($student_attendace_attach_data);

    }
}
