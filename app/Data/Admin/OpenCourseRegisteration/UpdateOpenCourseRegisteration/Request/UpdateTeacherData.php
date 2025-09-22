<?php

namespace App\Data\Admin\OpenCourseRegisteration\UpdateOpenCourseRegisteration\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema('AdminCourseCreateOpenCourseRegisterationRequestCourseTeacherData')]
class UpdateTeacherData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public bool $is_main_teacher,
    ) {}
}
