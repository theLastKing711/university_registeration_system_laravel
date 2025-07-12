<?php

namespace App\Data\Student\OpenCourseRegisteration\UnRegisterFromOpenCourse\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'StudentOpenCourseRegisterationUnRegisterFromOpenCourseRequestUnRegisterFromOpenCourseRequestData')]
class UnRegisterFromOpenCourseRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'studentsOpenCourseRegisterationIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('open_course_registerations', 'id')
        ]
        public int $id,
    ) {}
}
