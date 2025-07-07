<?php

namespace App\Data\Admin\Teacher\GetTeacher\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminTeacherGetTeacherRequestGetTeacherRequestData')]
class GetTeacherRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                ref: 'adminsTeacherIdPathParameter'
            ),
            FromRouteParameter('id'),
            Exists('teachers', 'id')
        ]
        public int $id,
    ) {}
}
