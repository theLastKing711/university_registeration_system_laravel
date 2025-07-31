<?php

namespace App\Data\Admin\Student\DeleteStudentProfilePicture\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminStudentDeleteStudentProfilePictureRequestDeleteStudentProfilePictureRequestData')]
class DeleteStudentProfilePictureRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsStudentDeleteStudentProfilePictureExtreRefIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('users', 'id')
        ]
        public int $id,
        #[
            OAT\PathParameter(
                parameter: 'adminsStudentDeleteStudentProfilePictureIdPathParameter',
                name: 'profile_picture_id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('profile_picture_id'),
            Exists('media', 'id')
        ]
        public int $profile_picture_id,
    ) {}
}
