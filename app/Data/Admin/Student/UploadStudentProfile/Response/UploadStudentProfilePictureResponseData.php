<?php

namespace App\Data\Admin\Student\UploadStudentProfile\Response;

use App\Data\Shared\Media\MediaData;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminStudentUploadStudentProfileResponseUploadStudentProfilePictureRequestData')]
class UploadStudentProfilePictureResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public MediaData $file,
    ) {}
}
