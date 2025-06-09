<?php

namespace App\Data\Admin\Course;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\Validation\Present;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class CreateCourseRequestData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $code,
        #[OAT\Property]
        public bool $is_active,
        #[OAT\Property]
        public int $credits,
        #[OAT\Property]
        public ?int $department_id,
        #[ArrayProperty(), Present]
        public array $prerequisites_ids,
    ) {}
}
