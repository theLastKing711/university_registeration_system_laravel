<?php

namespace App\Data\Admin\Student\UploadStudentProfile\Request;

use App\Data\Shared\Swagger\Property\FileProperty;
use Illuminate\Http\UploadedFile;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminStudentUploadStudentProfileRequestUploadStudentProfilePictureRequestData')]
class UploadStudentProfilePictureRequestData extends Data
{
    public function __construct(
        #[
            FileProperty,
            Image,
            Between(512, 1024)
        ]
        public UploadedFile $file,
    ) {}
}
