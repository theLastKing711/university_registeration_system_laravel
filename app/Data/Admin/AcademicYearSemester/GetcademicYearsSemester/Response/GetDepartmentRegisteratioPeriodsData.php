<?php

namespace App\Data\Admin\AcademicYearSemester\GetcademicYearsSemester\Response;

use App\Models\DepartmentRegisterationPeriod;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterGetDepartmentRegisterationDataGetcademicYearsSemesterResponseData')]
class GetDepartmentRegisteratioPeriodsData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
        #[
            OAT\Property,
        ]
        public ?bool $is_open_for_students,
    ) {}

    public static function fromModel(DepartmentRegisterationPeriod $department_registeration_period): self
    {
        return new self(
            $department_registeration_period->department->id,
            $department_registeration_period->department->name,
            $department_registeration_period->is_open_for_students
        );
    }
}
