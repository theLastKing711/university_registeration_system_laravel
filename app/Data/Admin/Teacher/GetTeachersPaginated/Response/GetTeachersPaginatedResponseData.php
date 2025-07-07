<?php

namespace App\Data\Admin\Teacher\GetTeachersPaginated\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminTeacherGetTeachersPaginatedResponseGetTeachersPaginatedResponseData')]
class GetTeachersPaginatedResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
    ) {}
}
