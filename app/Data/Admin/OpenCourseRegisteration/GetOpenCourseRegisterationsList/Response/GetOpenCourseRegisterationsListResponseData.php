<?php

namespace App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationsList\Response;

use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminOpenCourseRegisterationGetOpenCourseRegisterationListResponseGetOpenCourseRegisterationListResponseData')]
class GetOpenCourseRegisterationsListResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
    ) {}

    public static function fromModel(OpenCourseRegisteration $open_course_registeration): self
    {
        return new self(
            $open_course_registeration->id,
            $open_course_registeration->course->name
        );
    }
}
