<?php

namespace App\Http\Controllers\Admin\Notification\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/admins/notifications/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/AdminNotificationMarkNotificationAsReadRequestMarkNotificationAsReadRequestDataIdPathParameter',
            ),
        ],
    ),
]
abstract class NotificationController extends Controller {}
