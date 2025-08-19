<?php

namespace App\Data\Admin\Course\GetCoursesList\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseGetCoursesListRequestGetCoursesListResponseData')]
class GetCoursesListRequestData extends Data
{
    public function __construct(
        public ?int $department_id,
    ) {}

}
