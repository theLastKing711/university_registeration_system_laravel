<?php

namespace App\Data\Admin\Exam\GetExamsSchedule\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminExamGetExamsScheduleResponseGetExamsScheduleResponseData')]
class GetExamsScheduleResponseData extends Data
{
    public function __construct(

    ) {}

}
