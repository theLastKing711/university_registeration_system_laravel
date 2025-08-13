<?php

namespace App\Data\Admin\AcademicYearSemester\UpdateAcademicYearSemester\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterGetDepartmentRegisterationDataUpdateDepartmentData')]
class UpdateDepartmentData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[
            OAT\Property,
            Required
        ]
        public ?bool $is_open_for_students,
    ) {}

}
