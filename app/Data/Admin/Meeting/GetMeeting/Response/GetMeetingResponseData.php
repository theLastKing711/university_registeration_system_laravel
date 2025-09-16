<?php

namespace App\Data\Admin\Meeting\GetMeeting\Response;

use App\Data\Admin\Meeting\GetMeetings\Response\GetAttendanceData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;

class GetMeetingResponseData extends Data
{
    public function __construct(
        public int $id,
        #[ArrayProperty(GetAttendanceData::class)]
        /** @var Collection<GetAttendanceData> */
        public Collection $attendances,
    ) {}
}
