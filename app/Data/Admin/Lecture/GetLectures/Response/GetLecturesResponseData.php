<?php

namespace App\Data\Admin\Lecture\GetLectures\Response;

use App\Data\Shared\Swagger\Property\DateProperty;
use App\Models\Lecture;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminLectureGetLecturesResponseGetLecturesResponseData')]
class GetLecturesResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[DateProperty]
        public string $happened_at,
        #[OAT\Property]
        public string $course_name,
        #[OAT\Property]
        public string $teacher_name,
    ) {}

    public static function fromModel(Lecture $lecture): self
    {
        return new self(
            $lecture->id,
            $lecture->happened_at,
            $lecture->courseTeacher->course->course->name,
            $lecture->courseTeacher->teacher->name,
        );
    }
}
