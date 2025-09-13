<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Data\Admin\Notification\GetNotifications\Request\GetNotificationsRequestData;
use App\Data\Admin\Notification\GetNotifications\Response\GetNotificationsResponseData;
use App\Data\Admin\Notification\GetNotifications\Response\GetNotificationsResponsePaginationResultData;
use App\Data\Shared\Swagger\Parameter\QueryParameter\QueryParameter;
use App\Data\Shared\Swagger\Response\SuccessItemResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class GetNotificationsController extends Controller
{
    #[OAT\Get(path: '/admins/notifications', tags: ['adminsNotifications'])]
    #[QueryParameter('page', 'integer')]
    #[QueryParameter('perPage', 'integer')]
    #[SuccessItemResponse(GetNotificationsResponsePaginationResultData::class)]
    public function __invoke(GetNotificationsRequestData $request)
    {

        return $notifications =
            Auth::User()
                ->adminNotifications()
                ->cursorPaginate(
                    perPage: 1
                );

        return GetNotificationsResponseData::collect(
            $notifications->data
        );
    }
}
