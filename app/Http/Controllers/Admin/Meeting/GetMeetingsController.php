<?php

namespace App\Http\Controllers\Admin\Meeting;

use App\Data\Admin\Meeting\GetMeetings\Response\GetMeetingsResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetMeetingsController extends Controller
{
    #[OAT\Get(path: '/admins/meetings', tags: ['adminsMeetings'])]
    #[SuccessListResponse(GetMeetingsResponseData::class)]
    public function __invoke()
    {
        return GetMeetingsResponseData::collect(
            Meeting::query()
                ->whereHas(
                    'attendances',
                    fn ($query) => $query
                        ->where(
                            'users.id',
                            Auth::User()->id
                        )
                )
                ->get()
        );
    }
}
