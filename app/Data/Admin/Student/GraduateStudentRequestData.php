<?php

namespace App\Data\Admin\Student;

use App\Data\Shared\Swagger\Property\DateProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class GraduateStudentRequestData extends Data
{
    public function __construct(
        #[DateProperty]
        public string $graduation_date,
    ) {}
}
