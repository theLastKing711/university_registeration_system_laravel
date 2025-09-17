<?php

namespace App\Data\Admin\Meeting\GetMeetings\Response;

use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminMeetingGetMeetingsResponseGetMeetingsResponseData')]
class GetMeetingsResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public ?Carbon $happens_at,
        #[ArrayProperty(GetAttendanceData::class)]
        /** @var Collection<GetAttendanceData> */
        public Collection $attendances,
    ) {}

}
