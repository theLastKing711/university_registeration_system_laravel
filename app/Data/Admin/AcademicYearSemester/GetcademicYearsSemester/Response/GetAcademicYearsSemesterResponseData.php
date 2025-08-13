<?php

namespace App\Data\Admin\AcademicYearSemester\GetcademicYearsSemester\Response;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\AcademicYearSemester;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterGetcademicYearsSemesterResponseGetcademicYearsSemesterResponseData')]
class GetAcademicYearsSemesterResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,
        #[ArrayProperty(GetDepartmentRegisteratioPeriodsData::class)]
        /** @var Collection<GetDepartmentRegisteratioPeriodsData> */
        public Collection $departments,
    ) {}

    public static function fromModel(AcademicYearSemester $academic_year_semester): self
    {
        return new self(
            $academic_year_semester->id,
            $academic_year_semester->year,
            $academic_year_semester->semester,
            GetDepartmentRegisteratioPeriodsData::collect(
                $academic_year_semester
                    ->departmentRegisterationPeriods
            )

        );
    }
}
