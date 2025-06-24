<?php

namespace App\Data\Admin\Exam\GetExam\Response;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema()]
class GetExamResponseData extends Data
{
    public function __construct(

    ) {}

}
