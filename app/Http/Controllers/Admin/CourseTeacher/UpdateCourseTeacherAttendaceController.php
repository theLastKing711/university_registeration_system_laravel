<?php

namespace App\Http\Controllers\Admin\CourseTeacher;

use App\Data\Admin\CourseTeacher\UpdateCourseTeacherAttendace\Request\StudentAttendanceItemData;
use App\Data\Admin\CourseTeacher\UpdateCourseTeacherAttendace\Request\UpdateCourseTeacherAttandenceRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\CourseTeacher\Abstract\CourseTeacherAttendanceController;
use App\Models\Lecture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;

class UpdateCourseTeacherAttendaceController extends CourseTeacherAttendanceController
{
    #[OAT\Patch(path: '/admins/course-teachers/{id}/lectures/{lecture_id}', tags: ['adminsCourseTeachers'])]
    #[JsonRequestBody(UpdateCourseTeacherAttandenceRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateCourseTeacherAttandenceRequestData $request)
    {
        Log::info($request->all());

        $student_attendace_attach_data =
            $request
                ->students_attendandces
                ->mapWithKeys(function (StudentAttendanceItemData $student) {

                    return
                        [
                            $student->id => [
                                'is_student_present' => $student->is_student_present,
                            ],
                        ];

                })
                ->all();

        DB::transaction(function () use ($request, $student_attendace_attach_data) {

            $lecture = Lecture::query()
                ->firstWhere(
                    'id',
                    $request->lecture_id
                );

            $lecture
                ->update([
                    'course_teacher_id' => $request->id,
                    'happened_at' => $request->happened_at,
                ]);

            $lecture
                ->students()
                ->sync($student_attendace_attach_data);

        });

    }
}
