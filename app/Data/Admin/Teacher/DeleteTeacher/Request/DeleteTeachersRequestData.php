<?php

namespace App\Data\Admin\Teacher\DeleteTeacher\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class DeleteTeachersRequestData extends Data
{
    public function __construct(
        #[ArrayProperty]
        public array $ids,
    ) {}
}
