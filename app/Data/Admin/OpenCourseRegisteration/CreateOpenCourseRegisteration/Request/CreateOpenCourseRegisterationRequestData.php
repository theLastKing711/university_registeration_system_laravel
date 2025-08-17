<?php

namespace App\Data\Admin\OpenCourseRegisteration\CreateOpenCourseRegisteration\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminOpenCourseRegisterationCreateOpenCourseRegisterationRequestCreateOpenCourseRegisterationRequestData')]
class CreateOpenCourseRegisterationRequestData extends Data
{
    public function __construct(
        #[
            OAT\Property,
            Exists('courses', 'id')
        ]
        public int $course_id,
        #[OAT\Property]
        public int $academic_year_semester_id,
        #[OAT\Property]
        public int $price_in_usd,

        #[ArrayProperty(CreateTeacherData::class)]
        /** @var Collection<CreateTeacherData> */
        public Collection $teachers,

    ) {}

}
