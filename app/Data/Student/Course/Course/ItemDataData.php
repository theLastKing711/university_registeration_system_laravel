<?php

namespace App\Data\Student\Course\Course;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema()]
class ItemDataData extends Data
{
    public function __construct(

    ) {}

}
