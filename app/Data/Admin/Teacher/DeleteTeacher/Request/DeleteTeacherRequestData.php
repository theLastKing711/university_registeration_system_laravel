<?php

namespace App\Data\Admin\Teacher\DeleteTeacher\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminTeacherDeleteTeacherRequestDeleteTeacherRequestData')]
class DeleteTeacherRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: '#/components/parameters/adminsTeacherPathParameter',
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
