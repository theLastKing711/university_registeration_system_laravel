<?php

namespace App\Data\Admin\Teacher\GetTeachers\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminTeacherGetTeachersResponseGetTeachersResponseData')]
class GetTeachersResponseData extends Data
{
    public function __construct(

    ) {}

}
