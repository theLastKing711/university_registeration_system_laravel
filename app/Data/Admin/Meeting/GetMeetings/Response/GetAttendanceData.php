<?php

namespace App\Data\Admin\Meeting\GetMeetings\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminMeetingGetMeetingsResponseGetAttendanceDataData')]
class GetAttendanceData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
    ) {}

}
