<?php

namespace App\Data\Admin\Meeting\GetMeetings\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminMeetingGetMeetingsRequestGetMeetingsRequestData')]
class GetMeetingsRequestData extends Data
{
    public function __construct(
        public ?int $year,
        public ?int $month,

    ) {}

}
