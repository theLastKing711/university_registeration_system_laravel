<?php

namespace App\Data\Admin\Notification\MarkNotificationsAsRead\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminNotificationMarkNotificationsAsReadRequestMarkNotificationsAsReadRequestData')]
class MarkNotificationsAsReadRequestData extends Data
{
    public function __construct(

    ) {}

}
