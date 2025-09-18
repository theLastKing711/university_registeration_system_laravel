<?php

namespace App\Data\Admin\Meeting\UpdateMeeting\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminMeetingUpdateMeetingRequestUpdateAttendanceData')]
class UpdateAttendanceData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
    ) {}

}
