<?php

namespace App\Data\Admin\Course;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class DeleteCoursesRequestData extends Data
{
    public function __construct(
        #[ArrayProperty]
        public array $ids,
    ) {}
}
