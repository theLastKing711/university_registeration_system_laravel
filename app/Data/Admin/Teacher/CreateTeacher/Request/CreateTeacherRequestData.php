<?php

namespace App\Data\Admin\Teacher\CreateTeacher\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class CreateTeacherRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public int $department_id,
    ) {}
}
