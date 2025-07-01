<?php

namespace App\Data\Admin\Course\GetCourses\Response;

use App\Data\Shared\Swagger\Property\DateProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminCourseGetCoursesResponseGetCoursesResponseData')]
class GetCoursesResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public int $department_id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $code,
        #[OAT\Property]
        public bool $is_active,
        #[OAT\Property]
        public int $credits,
        #[OAT\Property]
        public int $open_for_students_in_year,
        #[DateProperty]
        public string $created_at,
    ) {}
}
