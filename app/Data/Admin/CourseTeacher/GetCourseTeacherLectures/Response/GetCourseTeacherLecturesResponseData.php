<?php

namespace App\Data\Admin\CourseTeacher\GetCourseTeacherLectures\Response;

use App\Data\Shared\Swagger\Property\DateProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseTeacherGetCourseTeacherLecturesResponseGetCourseTeacherLecturesResponseData')]
class GetCourseTeacherLecturesResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[DateProperty]
        public string $happened_at,
    ) {}
}
