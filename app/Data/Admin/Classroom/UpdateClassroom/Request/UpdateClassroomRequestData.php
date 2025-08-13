<?php

namespace App\Data\Admin\Classroom\UpdateClassroom\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminClassroomUpdateClassroomRequestUpdateClassroomRequestData')]
class UpdateClassroomRequestData extends Data
{
    public function __construct(

        #[OAT\Property]
        public string $name,

        #[
            OAT\PathParameter(
                parameter: 'adminsClassroomsUpdateCoursePathParameterData',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('classrooms', 'id')
        ]
        public int $id,
    ) {}

}
