<?php

namespace App\Http\Controllers\Admin\Lecture;

use App\Data\Admin\Lecture\CreateLecture\Request\CreateLectureRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use App\Models\Lecture;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class CreateLectureController extends Controller
{
    #[OAT\Post(path: '/admins/lectures', tags: ['adminsLectures'])]
    #[JsonRequestBody(CreateLectureRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateLectureRequestData $request)
    {
        DB::transaction(function () use ($request) {

            $course_teacher =
                CourseTeacher::query()
                    ->firstWhere(
                        [
                            'course_id' => $request->course_id,
                            'teacher_id' => $request->teacher_id,

                        ]
                    );

            $lecutre =
                Lecture::query()
                    ->create([
                        'course_teacher_id' => $course_teacher->id,
                        'happened_at' => $request->happened_at,
                    ]);

            $course_attendace_data =
                $request
                    ->course_attendance
                    ->map(fn ($item) => [
                        'student_id' => $item->student_id,
                        'is_student_present' => $item->is_student_present,
                    ]
                    );

            $lecutre
                ->attendances()
                ->createMany(
                    $course_attendace_data
                );

        });
    }
}
