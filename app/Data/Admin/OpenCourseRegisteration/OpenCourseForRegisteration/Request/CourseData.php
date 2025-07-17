<?php

namespace App\Data\Admin\OpenCourseRegisteration\OpenCourseForRegisteration\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'app\Data\Admin\OpenCourseRegisteration\OpenCourseForRegisteration\Request\OpenCourseData.php')]
class CourseData extends Data
{
    public function __construct(
        #[
            OAT\Property,
            Exists('courses', 'id')
        ]
        public int $id,
        #[
            OAT\Property(default: 0),
            Regex('/^[0-9]*(\.[0-9]{0,2})?$/'),
            Numeric,
            GreaterThan(0),
        ]
        public string $price,
    ) {}
}
