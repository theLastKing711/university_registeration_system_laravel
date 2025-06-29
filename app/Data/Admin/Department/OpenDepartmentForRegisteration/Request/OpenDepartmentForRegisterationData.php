<?php

namespace App\Data\Admin\Department\OpenDepartmentForRegisteration\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
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

        #[
            OAT\PathParameter(
                parameter: 'adminsDepartmentIdPathParameterData', // the name used in ref
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('departments', 'id')
        ]
        public int $id,

    ) {}
}
