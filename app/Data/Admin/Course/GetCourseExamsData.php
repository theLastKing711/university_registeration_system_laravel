<?php

namespace App\Data\Admin\Course;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GetCourseExamsData extends Data
{
    public function __construct(

    ) {}
}
