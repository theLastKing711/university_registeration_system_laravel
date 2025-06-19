<?php

namespace App\Data\Admin\Exam\UpdateExam\Request;

use App\Data\Shared\Swagger\Property\DateProperty;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema()]
class UpdateExamRequestData extends Data
{
    public function __construct(
        #[
            OAT\Property,
            Exists('course_teacher', 'id')
        ]
        public int $course_teacher_id,
        #[
            OAT\Property,
            Exists('classrooms', 'id')
        ]
        public int $classroom_id,
        #[OAT\Property]
        public int $max_mark,
        #[DateProperty]
        public string $date,
        #[
            OAT\Property(default: '08:00:00'),
            DateFormat('H:i:s')
        ]
        public string $from,
        #[
            OAT\Property(default: '10:00:00'),
            DateFormat('H:i:s')
        ]
        public string $to,
        #[OAT\Property]
        public bool $is_main_exam,

        #[
            OAT\PathParameter(
                parameter: 'adminsUpdateExamPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('exams', 'id')
        ]
        public int $id,
    ) {}
}
