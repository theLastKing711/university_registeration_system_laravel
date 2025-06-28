<?php

namespace App\Data\Admin\AcademicYearSemester\GetcademicYearsSemesters\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterGetcademicYearsSemestersResponseGetAcademicYearsSemestersResponseData')]
class GetAcademicYearsSemestersResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,
    ) {}
}
