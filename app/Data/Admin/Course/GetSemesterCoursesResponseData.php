<?php

namespace App\Data\Admin\Course;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetSemesterCoursesResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
    ) {}
}
