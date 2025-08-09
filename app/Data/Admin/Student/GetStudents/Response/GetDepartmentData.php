<?php

namespace App\Data\Admin\Student\GetStudents\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAdminGetStudentsResponseGetDepartmentData')]
class GetDepartmentData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        public string $name,
    ) {}
}
