<?php

namespace App\Http\Controllers\Admin\Meeting;

use App\Data\Admin\Meeting\UpdateMeeting\Request\UpdateMeetingRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/meetings/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/usersTestPathParameterData',
            ),
        ],
    ),
]
class UpdateMeetingController extends Controller
{
    #[OAT\Patch(path: '/admins/meetings/{id}', tags: ['adminsMeetings'])]
    #[JsonRequestBody(UpdateMeetingRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateMeetingRequestData $request)
    {
        DB::transaction(function () use ($request) {

            $meeting =
                Meeting::query()
                    ->firstWhere(
                        'id',
                        $request->id
                    );

            $meeting
                ->update([
                    'happens_at' => $request->happens_at,
                ]);

            $meeting
                ->attendances()
                ->sync(
                    $request
                        ->attendances
                        ->pluck('id')
                );

        });

    }
}
