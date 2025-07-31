<?php

namespace App\Data\Admin\Student\UpdateStudentProfilePicture\Response;

use App\Data\Shared\Swagger\Property\FileProperty;
use Illuminate\Http\UploadedFile;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminStudentUpdateStudentProfilePictureResponseUpdateStudentProfilePictureResponseData')]
class UpdateStudentProfilePictureResponseData extends Data
{
    public function __construct(
        #[FileProperty]
        public ?UploadedFile $file,
    ) {}
}
