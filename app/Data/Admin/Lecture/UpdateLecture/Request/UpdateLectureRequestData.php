<?php

namespace App\Data\Admin\Lecture\UpdateLecture\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\Lecture;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminLectureUpdateLectureRequestUpdateLectureRequestData')]
class UpdateLectureRequestData extends Data
{
    public function __construct(

        #[DateProperty]
        public Carbon $happened_at,
        #[OAT\Property]
        public int $course_id,
        #[OAT\Property]
        public int $teacher_id,
        #[ArrayProperty(CourseAttendanceData::class)]
        /** @var Collection<CourseAttendanceData> */
        public Collection $course_attendance,

        #[
            OAT\PathParameter(
                parameter: 'adminsLectureUpdlateLectureREuqstDataIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists(Lecture::class, 'id')
        ]
        public int $id,
    ) {}

}
