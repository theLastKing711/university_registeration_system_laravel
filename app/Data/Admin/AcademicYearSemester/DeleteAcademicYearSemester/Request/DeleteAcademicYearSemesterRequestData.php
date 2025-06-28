<?php

namespace App\Data\Admin\AcademicYearSemester\DeleteAcademicYearSemester\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminAcademicYearSemesterDeleteAcademicYearSemesterRequestDeleteAcademicYearSemesterRequestData')]
class DeleteAcademicYearSemesterRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,

        #[
            OAT\PathParameter(
                parameter: 'adminsDeleteAcademicYearSemesterIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('academic_year_semesters', 'id')
        ]
        public int $id,
    ) {}
}
