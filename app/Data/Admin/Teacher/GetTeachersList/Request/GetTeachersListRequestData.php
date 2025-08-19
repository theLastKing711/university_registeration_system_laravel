<?php

namespace App\Data\Admin\Teacher\GetTeachersList\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminTeacherGetTeachersListResponseGetTeachersListRequestDataa')]
class GetTeachersListRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public ?int $course_id,
    ) {}

}
