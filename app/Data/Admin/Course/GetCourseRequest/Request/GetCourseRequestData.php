<?php

namespace App\Data\Admin\Course\GetCourseRequest\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseGetCourseRequestRequestGetCourseRequestData')]
class GetCourseRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsCoursesGetCourseIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('courses', 'id')
        ]
        public int $id,
    ) {}
}
