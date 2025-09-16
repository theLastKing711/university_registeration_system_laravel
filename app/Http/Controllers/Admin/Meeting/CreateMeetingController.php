<?php

namespace App\Http\Controllers\Admin\Meeting;

use App\Data\Admin\Meeting\CreateMeeting\Request\CreateMeetingRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class CreateMeetingController extends Controller
{
    #[OAT\Post(path: '/admins/meetings', tags: ['adminsMeetings'])]
    #[JsonRequestBody(CreateMeetingRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(CreateMeetingRequestData $request)
    {

        DB::transaction(function () use ($request) {
            $meeting =
                Meeting::query()
                    ->create([
                        'happens_at' => $request->happens_at,
                    ]);

            $meeting->attendances()->attach(
                $request->attendances->map(fn ($attendance) => $attendance->id)
            );

        });

    }
}
