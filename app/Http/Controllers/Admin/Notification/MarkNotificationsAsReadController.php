<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Data\Admin\Notification\MarkNotificationsAsRead\Request\MarkNotificationsAsReadRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OAT;

class MarkNotificationsAsReadController extends Controller
{
    #[OAT\Patch(path: '/admins/notifications', tags: ['adminsNotifications'])]
    #[JsonRequestBody(MarkNotificationsAsReadRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(MarkNotificationsAsReadRequestData $request)
    {
        Auth::User()
            ->unreadNotifications()
            ->get()
            ->markAsRead();
    }
}
