<?php

namespace App\Data\Admin\Department;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class OpenDepartmentForRegisterationData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $course_registeration_year,
        #[OAT\Property]
        public int $course_registeration_semester,
    ) {}
}
