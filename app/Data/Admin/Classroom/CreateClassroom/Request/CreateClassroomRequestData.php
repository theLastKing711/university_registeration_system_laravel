<?php

namespace App\Data\Admin\Classroom\CreateClassroom\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminClassroomCreateClassroomRequestCreateClassroomRequestData')]
class CreateClassroomRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,
    ) {}

}
