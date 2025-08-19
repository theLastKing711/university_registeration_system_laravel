<?php

namespace App\Data\Admin\Classroom\GetClassroomList\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminClassroomGetClassroomListResponseGetClassroomListResponseData')]
class GetClassroomListResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
    ) {}

}
