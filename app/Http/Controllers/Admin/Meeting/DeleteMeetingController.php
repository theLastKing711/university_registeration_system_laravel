<?php

namespace App\Http\Controllers\Admin\Meeting;

use App\Data\Admin\Meeting\DeleteMeeting\Request\DeleteMeetingRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Meeting\Abstract\MeetingController;
use App\Models\Meeting;
use OpenApi\Attributes as OAT;

class DeleteMeetingController extends MeetingController
{
    #[OAT\Delete(path: '/admins/meetings/{id}', tags: ['adminsMeetings'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteMeetingRequestData $request)
    {
        Meeting::query()
            ->firstWhereId(
                $request->id
            )
            ->delete();
    }
}
