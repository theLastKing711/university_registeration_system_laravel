<?php

namespace App\Data\Admin\Classroom\GetClassroomList\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminClassroomGetClassroomListRequestGetClassroomListRequestData')]
class GetClassroomListRequestData extends Data
{
    public function __construct(

    ) {}

}
