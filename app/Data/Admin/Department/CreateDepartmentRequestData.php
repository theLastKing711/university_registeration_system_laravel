<?php

namespace App\Data\Admin\Department;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class CreateDepartmentRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,
    ) {}
}
