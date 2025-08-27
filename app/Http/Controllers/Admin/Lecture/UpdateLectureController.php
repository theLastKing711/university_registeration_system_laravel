<?php

namespace App\Http\Controllers\Admin\Lecture;

use App\Data\Admin\Lecture\UpdateLecture\Request\UpdateLectureRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Lecture\Abstract\LectureController as AbstractLectureController;
use App\Models\CourseTeacher;
use App\Models\Lecture;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class UpdateLectureController extends AbstractLectureController
{
    #[OAT\Patch(path: '/admins/lectures/{id}', tags: ['adminsLectures'])]
    #[JsonRequestBody(UpdateLectureRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateLectureRequestData $request)
    {

        DB::transaction(function () use ($request) {

            $lecture =
                Lecture::query()
                    ->firstWhere(
                        'id',
                        $request->id
                    );

            $course_teacher =
                CourseTeacher::query()
                    ->firstWhere(
                        [
                            'course_id' => $request->course_id,
                            'teacher_id' => $request->teacher_id,

                        ]
                    );

            $lecture
                ->update([
                    'course_teacher_id' => $course_teacher->id,
                    'happened_at' => $request->happened_at,
                ]);

            $course_attendance_data =
                $request
                    ->course_attendance
                    ->map(fn ($item) => [
                        // 'id' => $item->id,
                        'student_id' => $item->student_id,
                        'is_student_present' => $item->is_student_present,
                    ]
                    )
                    ->all();

            $lecture
                ->attendances()
                ->delete();

            $lecture
                ->attendances()
                ->createMany($course_attendance_data);

            // $lecture
            //     ->attendances()
            //     ->update(...$course_attendance_data);

        });

    }
}
