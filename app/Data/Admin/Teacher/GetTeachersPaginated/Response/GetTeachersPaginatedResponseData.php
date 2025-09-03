<?php

namespace App\Data\Admin\Teacher\GetTeachersPaginated\Response;

use App\Models\Teacher;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminTeacherGetTeachersPaginatedResponseGetTeachersPaginatedResponseData')]
class GetTeachersPaginatedResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $department_name,
    ) {}

    // public static function fromModel(Teacher $teacher): self
    // {
    //     return new self(
    //         $teacher->id,
    //         $teacher->name,
    //         $teacher->department->name
    //     );
    // }
}
