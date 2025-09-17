<?php

namespace App\Http\Controllers\Admin\Meeting;

use App\Data\Admin\Meeting\GetMeetings\Request\GetMeetingsRequestData;
use App\Data\Admin\Meeting\GetMeetings\Response\GetMeetingsResponseData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetMeetingsController extends Controller
{
    #[OAT\Get(path: '/admins/meetings', tags: ['adminsMeetings'])]
    #[QueryParameter('year', 'integer')]
    #[QueryParameter('month', 'integer')]
    #[JsonRequestBody(GetMeetingsRequestData::class)]
    #[SuccessListResponse(GetMeetingsResponseData::class)]
    public function __invoke(GetMeetingsRequestData $request)
    {
        return GetMeetingsResponseData::collect(
            Meeting::query()
                ->with('attendances')
                ->whereHas(
                    'attendances',
                    fn ($query) => $query
                        ->where(
                            'users.id',
                            Auth::User()->id
                        )
                )
                ->when(
                    $request->year,
                    fn ($query) => $query
                        ->whereYear(
                            'happens_at',
                            $request->year
                        )
                )
                ->when(
                    $request->month,
                    fn ($query) => $query
                        ->whereMonth(
                            'happens_at',
                            $request->month
                        )
                )
                ->get()
        );
    }
}
