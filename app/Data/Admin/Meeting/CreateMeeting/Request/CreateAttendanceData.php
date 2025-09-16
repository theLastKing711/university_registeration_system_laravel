<?php

namespace App\Data\Admin\Meeting\CreateMeeting\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminMeetingCreateMeetingRequestCreateAttendanceDataData')]
class CreateAttendanceData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
    ) {}

}
