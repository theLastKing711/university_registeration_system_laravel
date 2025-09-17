<?php

namespace App\Data\Admin\Meeting\CreateMeeting\Request;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Data\Shared\Swagger\Property\DateProperty;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminMeetingCreateMeetingRequestCreateMeetingRequestData')]
class CreateMeetingRequestData extends Data
{
    public function __construct(
        #[DateProperty]
        public ?Carbon $happens_at,
        #[ArrayProperty(CreateAttendanceData::class)]
        /** @var Collection<CreateAttendanceData> */
        public Collection $attendances,
    ) {}

}
