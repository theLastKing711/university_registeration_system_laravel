<?php

namespace App\Data\Admin\Student\UploadStudentSchoolFiles\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminStudentUploadSchoolFilesRequestUploadSchoolFilesRequestData')]
class UploadStudentSchoolFilesRequestData extends Data
{
    public function __construct(
        // #[OAT\Property(
        //     type: 'array',
        //     items: new OAT\Items(
        //         type: 'string',
        //         format: 'binary'
        //     )
        // )
        // ]
        // public array $files,

        // #[ArrayProperty(TestFile::class)]
        // /** @var Collection<TestFile> */
        // public Collection $files,
        #[ArrayProperty(UploadedFile::class)]
        /** @var Collection<UploadedFile> */
        public array $files,

    ) {}

}

#[TypeScript]
#[Oat\Schema(schema: 'TestFile')]
class TestFile extends Data
{
    public function __construct(
        UploadedFile $file
    ) {}
}
