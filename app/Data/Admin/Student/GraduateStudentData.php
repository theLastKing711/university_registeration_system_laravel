<?php

namespace App\Data\Admin\Student;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema()]
class GraduateStudentData extends Data
{
    public function __construct(

    ) {}

}
