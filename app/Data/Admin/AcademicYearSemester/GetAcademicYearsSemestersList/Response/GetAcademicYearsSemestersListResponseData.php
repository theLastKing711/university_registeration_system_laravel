<?php

namespace App\Data\Admin\AcademicYearSemester\GetAcademicYearsSemestersList\Response;

use App\Models\AcademicYearSemester;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterGetAcademicYearSemesterListResponseData')]
class GetAcademicYearsSemestersListResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $title,
    ) {}

    public static function fromModel(AcademicYearSemester $academic_year_semester): self
    {

        $title =
            $academic_year_semester->year
            .
            '/'
            .
            $academic_year_semester->semester;

        return new self(
            $academic_year_semester->id,
            $title
        );
    }
}
