<?php

namespace App\Data\Admin\Course\PathParameters;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class CourseTeacherPathParameterData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsCourseTeacherPathParameterData', // the name used in ref
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('course_teacher', 'id')
        ]
        public int $id,
    ) {}
}
