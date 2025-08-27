<?php

namespace App\Data\Admin\Exam\GetExamsSchedule\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminExamGetExamsScheduleRequestGetExamsScheduleRequestData')]
class GetExamsScheduleRequestData extends Data
{
    public function __construct(

    ) {}

}
