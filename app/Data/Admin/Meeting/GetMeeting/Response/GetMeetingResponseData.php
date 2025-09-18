<?php

namespace App\Data\Admin\Meeting\GetMeeting\Response;

use App\Data\Admin\Meeting\GetMeetings\Response\GetAttendanceData;
use App\Data\Shared\Swagger\Property\ArrayProperty;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;

class GetMeetingResponseData extends Data
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

    // public static function fromModel(Meeting $meeting): self
    // {
    //     return new self(
    //         $meeting->id,
    //         Carbon::parse($meeting->happens_at)->setTimezone('UTC'),
    //         $meeting
    //             ->attendances
    //             ->map(fn ($item) => new GetAttendanceData($item->id, $item->name))
    //     );
    // }
}
