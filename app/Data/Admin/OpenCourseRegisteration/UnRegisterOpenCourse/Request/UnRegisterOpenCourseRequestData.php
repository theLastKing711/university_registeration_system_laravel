<?php

namespace App\Data\Admin\OpenCourseRegisteration\UnRegisterOpenCourse\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class UnRegisterOpenCourseRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminOpenCourseRegisterationPathParameter',
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
