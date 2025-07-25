<?php

namespace App\Data\Admin\OpenCourseRegisteration\OpenCourseForRegisteration\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
#[MergeValidationRules]
class OpenCourseForRegisterationRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?int $department_id,
        #[ArrayProperty(CourseData::class)]
        /** @var Collection<CourseData> */
        public Collection $courses,

    ) {}
}
