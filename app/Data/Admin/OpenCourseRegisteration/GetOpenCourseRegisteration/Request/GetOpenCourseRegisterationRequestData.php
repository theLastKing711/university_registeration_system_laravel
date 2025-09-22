<?php

namespace App\Data\Admin\OpenCourseRegisteration\GetOpenCourseRegisteration\Request;

use App\Models\OpenCourseRegisteration;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class GetOpenCourseRegisterationRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsGetOpenCourseRegisterationRequestPathParameterData', // the name used in ref
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
