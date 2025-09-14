<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Data\Admin\Notification\MarkNotificationAsRead\Request\MarkNotificationAsReadRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Notification\Abstract\NotificationController;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class MarkNotificationAsReadController extends NotificationController
{
    #[OAT\Patch(path: '/admins/notifications/{id}', tags: ['adminsNotifications'])]
    #[JsonRequestBody(MarkNotificationAsReadRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(MarkNotificationAsReadRequestData $request)
    {

        Auth::User()
            ->notifications()
            ->where('id', $request->id)
            ->first()
            ?->markAsRead();

    }
}
