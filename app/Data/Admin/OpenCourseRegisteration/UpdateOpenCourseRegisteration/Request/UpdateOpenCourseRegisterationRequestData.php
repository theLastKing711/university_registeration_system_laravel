<?php

namespace App\Data\Admin\OpenCourseRegisteration\UpdateOpenCourseRegisteration\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\OpenCourseRegisteration;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class UpdateOpenCourseRegisterationRequestData extends Data
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

        #[ArrayProperty(UpdateTeacherData::class)]
        /** @var Collection<UpdateTeacherData> */
        public Collection $teachers,

        #[
            OAT\PathParameter(
                parameter: 'adminsUpdateOpenCourseRegisterationRequestPathParameterData', // the name used in ref
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists(OpenCourseRegisteration::class, 'id')
        ]
        public int $id,
    ) {}
}
