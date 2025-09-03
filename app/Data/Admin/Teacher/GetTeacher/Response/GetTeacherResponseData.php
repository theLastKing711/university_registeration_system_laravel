<?php

namespace App\Data\Admin\Teacher\GetTeacher\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminTeacherGetTeacherResponseGetTeacherResponseData')]
class GetTeacherResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public int $department_id,
    ) {}
}
