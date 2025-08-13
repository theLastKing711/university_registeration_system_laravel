<?php

namespace App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisterations\Response;

use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminOpenCourseRegisterationGetOpenCourseRegisterationsResponseGetOpenCourseRegisterationsResponseData')]
class GetOpenCourseRegisterationsResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public int $course_id,
        #[OAT\Property]
        public string $course_name,
        #[OAT\Property]
        public int $academic_year_semester_id,
        #[OAT\Property]
        public int $year,
        #[OAT\Property]
        public int $semester,
        #[OAT\Property]
        public string $price_in_usd,
    ) {}

    public static function fromModel(OpenCourseRegisteration $openCourseRegisteration): self
    {
        return new self(
            $openCourseRegisteration->id,
            $openCourseRegisteration->course_id,
            $openCourseRegisteration->course->name,
            $openCourseRegisteration->academic_year_semester_id,
            $openCourseRegisteration->academicYearSemester->year,
            $openCourseRegisteration->academicYearSemester->semester,
            $openCourseRegisteration->price_in_usd

        );
    }
}
