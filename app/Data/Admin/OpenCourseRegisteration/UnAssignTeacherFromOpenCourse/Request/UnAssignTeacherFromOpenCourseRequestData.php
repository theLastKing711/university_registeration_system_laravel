<?php

namespace App\Data\Admin\OpenCourseRegisteration\UnAssignTeacherFromOpenCourse\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminOpenCourseRegisterationUnAssignTeacherFromOpenCourseRequestUnAssignTeacherFromOpenCourseRequestData')]
class UnAssignTeacherFromOpenCourseRequestData extends Data
{
    public function __construct(

        #[
            Exists('teachers', 'id')
        ]
        /** @var array<int> */
        public array $teachers_ids,

        #[
            OAT\PathParameter(
                parameter: 'adminsOpenCourseRegisterationUnAssignTeacherFromOpenCourseRequestDataIdPathParameter',
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
