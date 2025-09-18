<?php

namespace App\Http\Controllers\Admin\Meeting;

use App\Data\Admin\Meeting\GetMeeting\Request\GetMeetingRequestData;
use App\Data\Admin\Meeting\GetMeeting\Response\GetMeetingResponseData;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use App\Models\Meeting;
use OpenApi\Attributes as OAT;

class GetMeetingController extends Controller
{
    #[OAT\Get(path: '/admins/meetings/{id}', tags: ['adminsMeetings'])]
    #[SuccessItemResponse(GetMeetingResponseData::class)]
    public function __invoke(GetMeetingRequestData $request)
    {
        return GetMeetingResponseData::from(
            Meeting::query()
                ->with('attendances')
                ->firstWhereId(
                    $request->id
                )
        );
    }
}
