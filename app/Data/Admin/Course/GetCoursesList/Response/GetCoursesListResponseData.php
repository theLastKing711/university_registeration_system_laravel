<?php

namespace App\Data\Admin\Course\GetCoursesList\Response;

use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseGetCoursesListResponseGetCoursesListResponseData')]
class GetCoursesListResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
    ) {}

    public static function fromModel(OpenCourseRegisteration $open_course): self
    {
        return new self(
            $open_course->id,
            $open_course->course->name
        );
    }
}
