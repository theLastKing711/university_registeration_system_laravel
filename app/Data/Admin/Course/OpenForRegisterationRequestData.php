<?php

namespace App\Data\Admin\Course;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class OpenForRegisterationRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $department_id,
        #[
            ArrayProperty(),
            Exists('courses', 'id')
        ]

        public array $courses_ids,
    ) {}
}
