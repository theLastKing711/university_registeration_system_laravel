<?php

namespace App\Data\Admin\Course;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema()]
class GetCourseStudentsRespnseData extends Data
{
    public function __construct(

    ) {}

}
