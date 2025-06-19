<?php

namespace App\Data\Admin\Course\UpdateCourse\Request\Admin\Course;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class UpdateCourseRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $department_id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $code,
        #[OAT\Property]
        public bool $is_active,
        #[OAT\Property]
        public int $credits,
        #[OAT\Property]
        public int $open_for_students_in_year,
        #[
            OAT\PathParameter(
                parameter: 'adminsUpdateCoursePathParameterData',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('courses', 'id')
        ]
        public int $id
    ) {}
}
