<?php

namespace App\Data\Admin\Teacher\UpdateTeacher\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class UpdateTeacherRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,
        #[
            OAT\Property,
            Exists('departments', 'id')
        ]
        public int $department_id,
        #[
            OAT\PathParameter(
                parameter: 'adminsUpdateTeacherPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('teachers', 'id')
        ]
        public int $id,
    ) {}
}
