<?php

namespace App\Data\Student\Course;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class RegisterCoursesRequestData extends Data
{
    public function __construct(
        #[ArrayProperty]
        #[Exists('open_course_registerations', 'id')]
        public array $course_ids,
    ) {}
}
