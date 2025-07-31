<?php

namespace App\Data\Admin\Student\UpdateStudentProfilePictureRequest\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminStudentUpdateStudentProfilePictureRequestRequestUpdateStudentProfilePictureRequestData')]
class UpdateStudentProfilePictureRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsStudentsUpdateStudentProfilePictureRequestIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('', 'id')
        ]
        public int $id,
    ) {}
}
